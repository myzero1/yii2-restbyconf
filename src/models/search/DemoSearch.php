<?php

namespace myzero1\restbyconf\models\search;

use myzero1\restbyconf\components\rest\Helper;
use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\SearchHelper;
use myzero1\restbyconf\components\rest\CodeMsg;
use myzero1\restbyconf\components\rest\SearchProcessing;
use myzero1\restbyconf\models\Demo as DemoModel;

/**
 * This is the model class for table "demo".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class DemoSearch extends DemoModel implements SearchProcessing
{
    public $demo_name;
    public $demo_description;

    public $sort;
    public $page;
    public $page_size;

    /**
     * {@inheritdoc}
     */
    public $outFieldNames;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['demo_name', 'demo_description', 'sort', 'page', 'page_size'], 'trim'],

//            [['demo_name', 'demo_description'], 'required'],

            [['sort', 'page', 'page_siz'], 'safe'],
            [['page', 'page_size'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function processing()
    {
        $input = Yii::$app->request->queryParams;
        $validatedInput = $this->inputValidate($input);
        if (Helper::isReturning($validatedInput)) {
            return $validatedInput;
        } else {
            $db2outData = $this->getResult($validatedInput);
            $result = $this->completeResult($db2outData);
            return $result;
        }
    }

    public function inputValidate($input)
    {
        $this->load($input, '');

        if ($this->validate()) {
            foreach ($input as $k => $y) {
                $input[$k] = trim($y);
            }

            return $input;
        } else {
//            throw new ServerErrorHttpException('Failed to search items for validation reason.');
            $errors = $this->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }
    }

    public function getResult($validatedInput)
    {
        $result = [];
        $query = (new yii\db\Query())
            ->from($this->tableName());

        $query->where(['is_del' => 0]);
        $query->andFilterWhere([
            'and',
            ['like', 'name', $this->demo_name],
            ['like', 'description', $this->demo_description],
        ]);

        $query->select('1');
        $result['total'] = $query->count();

        $pagination = $this->getPagination($validatedInput);
        $query->limit($pagination['page_size']);
        $offset = $pagination['page_size'] * ($pagination['page'] - 1);
        $query->offset($offset);
        $result['page'] = $pagination['page_size'];
        $result['page_size'] = $pagination['page_size'];

        $outFieldNames = [
            'id' => 'id',
            'demo_name' => 'name as demo_name',
            'demo_description' => 'description as demo_description',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ];

        $sort = $this->getSort($validatedInput, array_keys($outFieldNames), '+id');
        $query->orderBy([$sort['sortFiled'] => $sort['sort']]);

        $query->select(array_values($outFieldNames));

        // var_dump($query->createCommand()->getRawSql());exit;
        $items = $query->all();
        $result['items'] = $this->mappingDb2output($items);

        return $result;
    }

    public function completeResult($db2outData)
    {
        $result = [
            'code' => CodeMsg::SUCCESS,
            'msg' => CodeMsg::SUCCESS_MSG,
            'data' => $db2outData,
        ];

        return $result;
    }

    public function getSort($validatedInput, $fields, $defafult)
    {
        if (isset($validatedInput['sort'])) {
            $sortInfo = Helper::getSort($validatedInput['sort'], $fields, $defafult);
        } else {
            $sortInfo = Helper::getSort('+myzeroqtest', $fields, $defafult);
        }

        return $sortInfo;
    }

    public function getPagination($validatedInput)
    {
        $pagination = [];
        if (isset($validatedInput['page'])) {
            $validatedInput['page'] = $validatedInput['page'];
        } else {
            $pagination['page'] = 1;
        }
        if (isset($validatedInput['page_size'])) {
            $pagination['page_size'] = $validatedInput['page_size'];
        } else {
            $pagination['page_size'] = 30;
        }

        return $pagination;
    }

    public function mappingDb2output($resultData)
    {
        foreach ($resultData as $k => $v) {
            $resultData[$k]['created_at'] = Helper::time2string($v['created_at']);
            $resultData[$k]['updated_at'] = Helper::time2string($v['updated_at']);
        }

        return $resultData;
    }
}
