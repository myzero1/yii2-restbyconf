<?php

namespace myzero1\restbyconf\controllers;

use yii\web\Controller;
use Yii;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * Default controller for the `test` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSwagger()
    { 
        return $this->renderAjax('swagger');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSwaggerJson()
    {
        $swaggerData = ApiHelper::getApiConf();
        $json = json_decode($swaggerData, true)['json'];
        $oldcontrollers = $json['controllers'];
        $oldcontrollers = ApiHelper::rmNode($json['controllers']);
        $controllers = [];
        $paths = [];

        foreach ($oldcontrollers as $k => $v) {
            $controller = [];
            $controller['name'] = $k;
            $controller['description'] = $v['description'];
            $controllers[] = $controller;

            $inputParams = [];
            $paths = ApiHelper::rmNode($v['paths']);
            foreach ($paths as $k1 => $v1) {
                $param = [];

                foreach ($v1['inputs'] as $k2 => $v2) {
                    $param[] = [
                        'in' => $v2['type'],
                        'name' => $v2,
                        'description' => $v2['des'],
                        'type' => 'string',
                        'required' => $v2['required'],
                        'example' => $v2['eg'],
                    ];
                }

                $inputParams[$k1] = $param;
            }

            $paths = [];
            $pathData = [];
            $pathOneData = [];
            $pathPre = sprintf('/%s/', ApiHelper::uncamelize($k,$separator='-'));
            $pathOnePre = sprintf('%s/{id}/', $pathPre);
            
            $pathsKey = array_keys($v['paths']);
            if (in_array('index', $pathsKey)) {
                $paths[$pathPre]['get'] = [
                    'controllers' => $k,
                    'description' => $v['description'],
                    'operationId' => sprintf('%sController.Get All', $k),
                    'parameters' => $inputParams['index'],
                ];
            }
            if (in_array('create', $pathsKey)) {
                $paths[$pathPre]['post'] = [
                    'controllers' => $k,
                    'description' => $v['description'],
                    'operationId' => sprintf('%sController.Post', $k),
                    'parameters' => $inputParams['create'],
                ];
            }
            if (in_array('view', $pathsKey)) {
                $paths[$pathOnePre]['get'] = [
                    'controllers' => $k,
                    'description' => $v['description'],
                    'operationId' => sprintf('%sController.Get One', $k),
                    'parameters' => $inputParams['view'],
                ];
            }
            if (in_array('update', $pathsKey)) {
                $paths[$pathOnePre]['put'] = [
                    'controllers' => $k,
                    'description' => $v['description'],
                    'operationId' => sprintf('%sController.Put', $k),
                    'parameters' => $inputParams['update'],
                ];
            }
            if (in_array('delete', $pathsKey)) {
                $paths[$pathOnePre]['delete'] = [
                    'controllers' => $k,
                    'description' => $v['description'],
                    'operationId' => sprintf('%sController.Delete', $k),
                    'parameters' => $inputParams['delete'],
                ];
            }
        }


        unset($json['controllers']);
        $json['tags'] = $controllers;
        $json['paths'] = $paths;

        // var_dump($json);exit;

        return json_encode($json);
        return $swaggerData;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionMarkdown()
    {
        return $this->render('markdown');
    }
}
