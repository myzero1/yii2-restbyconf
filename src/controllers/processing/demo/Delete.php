<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\controllers\processing\demo;

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
        $model = $this->findModel($id);
        $model->is_del = 1;

        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        $result = $this->completeResult();
        return $result;
    }

    /**
     * @param  array $db2outData completed data form database
     * @return array
     */
    public function completeResult()
    {
        $result = [
            'code' => CodeMsg::SUCCESS,
            'msg' => CodeMsg::SUCCESS_MSG,
            'data' => [],
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
}
