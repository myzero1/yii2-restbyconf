<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$tag = ucwords($generator->tag);
$tagV = $generator->tagV;
$actions = array_keys($tagV['paths']);
$moduleClass = $generator->moduleClass;
$controlerClass = sprintf('%s\controllers', dirname($moduleClass));
$processingClassNs = sprintf('%s\processing\%s', $controlerClass, $tag);
$searchClass = sprintf('\%s\models\search\%sSearch', dirname($moduleClass), $tag);



$inputs = $tagV['paths']['view']['inputs'];
$inputsKeys = array_keys($tagV['paths']['view']['inputs']);

$inputRules = [];
$inputRules[] = sprintf("\$model->addRule(['%s'], 'trim');", implode("','", $inputsKeys));

foreach ($inputs as $key => $value) {
    if ($value['required']) {
        $inputRules[] = sprintf("\$model->addRule(['%s'], 'required');", $key);
    }
    $inputRules[] = sprintf("\$model->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '%s']);", $key, $value['rules'], $value['error_msg']);
}

$egOutputData = [];
foreach ($tagV['paths']['view']['outputs'] as $key => $value) {
    $egOutputData[] = sprintf("'%s' => '%s',", $key, $value['eg']);
}

$outputs = $tagV['paths']['view']['outputs'];


echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace <?=$processingClassNs?>;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\CodeMsg;
use myzero1\restbyconf\components\rest\ViewProcessing;
use myzero1\restbyconf\models\Demo as Model;

/**
 * implement the ViewProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class View implements ViewProcessing
{
    /**
     * @param $id mixed
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($id)
    {

        // $model = $this->findModel($id);
        // $savedData = $model->attributes;
        // $db2outData = $this->mappingDb2output($savedData);
        $db2outData = $this->egOutputData();
        $result = $this->completeResult($db2outData);
        return $result;
    }

    /**
     * @param  array $savedData saved data
     * @return array
     */
    public function mappingDb2output($savedData)
    {
        $outputFieldMap = [
            'name' => 'demo_name',
            'description' => 'demo_description',
        ];
        $db2outData = Helper::db2OutputField($savedData, $outputFieldMap);

        $db2outData['created_at'] = Helper::time2string($db2outData['created_at']);
        $db2outData['updated_at'] = Helper::time2string($db2outData['updated_at']);

        return $db2outData;
    }

    /**
     * @param  array $db2outData completed data form database
     * @param  array $extra
     * @return array
     */
    public function completeResult($db2outData=[], $extra = [])
    {
        $result = [
            'code' => CodeMsg::SUCCESS,
            'msg' => CodeMsg::SUCCESS_MSG,
            'data' => $db2outData,
            'extra' => $extra,
        ];

        return $result;
    }

    /**
     * @param integer $id
     * @return model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Model::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @return array
     */
    public function egOutputData()
    {
        return [
<?php foreach ($egOutputData as $key => $value) { ?>
            <?=$value."\n"?>
<?php } ?>
        ];
    }
}
