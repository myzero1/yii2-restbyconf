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


$inputs = $tagV['paths']['delete']['inputs'];
$inputsKeys = array_keys($tagV['paths']['delete']['inputs']);

$inputRules = [];
// [['demo_name', 'demo_description', 'sort', 'page', 'page_size'], 'trim'],
$inputRules[] = sprintf("[['%s'], 'trim'],", implode("','", $inputsKeys));

foreach ($inputs as $key => $value) {
    if ($value['required']) {
        $inputRules[] = sprintf("[['%s'], 'required'],", $key);
    }
    $inputRules[] = sprintf("[['%s'], 'match', 'pattern' => '/%s/i', 'message' => '%s'],", $key, $value['rules'], $value['error_msg']);
}

$egOutputData = [];
foreach ($tagV['paths']['delete']['outputs'] as $key => $value) {
    $egOutputData[] = sprintf("'%s' => '%s',", $key, $value['eg']);
}

$outputs = $tagV['paths']['delete']['outputs'];



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
use myzero1\restbyconf\components\rest\DeleteProcessing;
use myzero1\restbyconf\models\Demo as Model;

/**
 * implement the DeleteProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class Delete implements DeleteProcessing
{
    /**
     * @param $id mixed
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($id)
    {
        /*
        $model = $this->findModel($id);
        $model->is_del = 1;
        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        */
        $db2outData = $this->egOutputData();
        $result = $this->completeResult($db2outData);
        return $result;
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
        $result = [
<?php foreach ($egOutputData as $key => $value) { ?>
            <?=$value."\n"?>
<?php } ?>
        ];
    }
}
