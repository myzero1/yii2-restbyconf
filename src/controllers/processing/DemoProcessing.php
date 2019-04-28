<?php

namespace myzero1\restbyconf\controllers\processing;

use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\models\DemoModel as Model;

/**
 * FriendsController implements the CRUD actions for SjEnterprise model.
 */
class DemoProcessing
{
    /**
     * @param array $input
     * @return array
     * @throws ServerErrorHttpException
     */
    public function create($input)
    {
        return [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => [
                'demo_name' => $input['demo_name'],
                'demo_description' => $input['demo_description'],
            ],
        ];

        // ------------You should processing it as flowing----------------------

        // input2DbField
        $inputFieldMap = [
            'demo_name' => 'name',
        ];
        $inputDb = Helper::input2DbField($input, $inputFieldMap);

        // validate
        $model = new Model();
        $model->load($inputDb, '');
        if (!$model->validate()) {
            $errors = $model->errors;
            return [
                'code' => ApiCodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        } else {
            // adjust input
            $model->id = time();

            // save
            if (!$model->save(false)) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            } else {
                // db2OutputField
                $outputFieldMap = [
                    'name' => 'demo_name',
                ];
                $modelArray = (array)$model;
                $outputField = Helper::db2OutputField($modelArray, $outputFieldMap);

                return [
                    'code' => ApiCodeMsg::SUCCESS,
                    'msg' => ApiCodeMsg::SUCCESS_MSG,
                    'data' => $outputField,
                ];
            }
        }
    }

    /**
     * @param integer $id
     * @param array $input
     * @return array
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     */
    public function update($id, $input)
    {
        return [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => [
                'demo_name' => $input['demo_name'],
                'demo_description' => $input['demo_description'],
            ],
        ];

        // ------------You should processing it as flowing----------------------

        // input2DbField
        $inputFieldMap = [
            'demo_name' => 'name',
        ];
        $inputDb = Helper::input2DbField($input, $inputFieldMap);

        // validate
        $model = $this->findModel($id);
        $model->load($inputDb, '');
        if (!$model->validate()) {
            $errors = $model->errors;
            return [
                'code' => ApiCodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        } else {
            // adjust input
            $model->id = time();

            // save
            if (!$model->save(false)) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            } else {
                // db2OutputField
                $outputFieldMap = [
                    'name' => 'demo_name',
                ];
                $modelArray = (array)$model;
                $outputField = Helper::db2OutputField($modelArray, $outputFieldMap);

                return [
                    'code' => ApiCodeMsg::SUCCESS,
                    'msg' => ApiCodeMsg::SUCCESS_MSG,
                    'data' => $outputField,
                ];
            }
        }
    }

    /**
     * @param integer $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function view($id)
    {
        return [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => [
                'demo_name' => 'myzero1',
                'demo_description' => 'I am a phper',
            ],
        ];

        // ------------You should processing it as flowing----------------------

        // find model
        $model = $this->findModel($id);

        // db2OutputField
        $outputFieldMap = [
            'name' => 'demo_name',
        ];
        $modelArray = (array)$model;
        $outputField = Helper::db2OutputField($modelArray, $outputFieldMap);

        return [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => $outputField,
        ];
    }

    /**
     * @param integer $id
     * @return array
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     */
    public function delete($id)
    {
        return [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => [],
        ];

        // ------------You should processing it as flowing----------------------

        // find model
        $model = $this->findModel($id);

        // delete it
        //$model->is_del = 1;
        // if ($model->save() === false) {
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        } else {
            return [
                'code' => ApiCodeMsg::SUCCESS,
                'msg' => ApiCodeMsg::SUCCESS_MSG,
                'data' => [],
            ];
        }
    }

    /**
     * @param integer $id
     * @return Model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Model::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The model does not exist.');
        }
    }
}
