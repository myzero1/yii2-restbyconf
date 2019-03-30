<?php

namespace myzero1\restbyconf\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use myzero1\restbyconf\models\SjEnterprise;
use myzero1\restbyconf\components\SearchHelper;
use myzero1\restbyconf\components\rest\CodeMsg;

/**
 * This is the model class for table "demo".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class DemoSearch extends DemoModel
{
    public $demo_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'],  'string', 'max' => 255],
            [['id'], 'unique', 'targetAttribute' => ['id']],

            [['demo_name'], 'required'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        $attributes = parent::attributes();
        return array_merge($attributes, [
            'demo_name',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query and sql applied
     *
     * @param array $params
     *
     * @return array
     */
    public function search($params)
    {

        $items = [];
        return [
            'code' => CodeMsg::SUCCESS,
            'msg' => CodeMsg::SUCCESS_MSG,
            'data' => [
                'page' => 1,
                'page_size' => 30,
                'total' => 55,
                'items' => $items,
            ],
        ];
    }
}
