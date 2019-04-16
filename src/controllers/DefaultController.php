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
        $actions = [];
        $paths = [];


        foreach ($oldcontrollers as $k => $v) {
            $controller = [];
            $controller['name'] = $k;
            $controller['description'] = $v['description'];
            $controllers[] = $controller;

            $inputParams = [];
            $pathsSource = ApiHelper::rmNode($v['actions']);
            foreach ($pathsSource as $k1 => $v1) {
                $path = [];
                $pathTag = '';

                $pathParams = [];
                $path_params = $v1['inputs']['path_params'];
                $path_params = ApiHelper::rmNode($path_params);
                foreach ($path_params as $k2 => $v2) {
                    $pathTag .= sprintf('/{%s}', $k2);
                    $pathParams[] = [
                        'in' => 'path',
                        'name' => $k2,
                        'description' => $v2['des'],
                        'type' => 'string',
                        'required' => $v2['required'],
                        'default' => $v2['eg'],
                    ];
                }

                $queryParams = [];
                $query_params = $v1['inputs']['query_params'];
                $query_params = ApiHelper::rmNode($query_params);
                foreach ($query_params as $k2 => $v2) {
                    $queryParams[] = [
                        'in' => 'query',
                        'name' => $k2,
                        'description' => $v2['des'],
                        'type' => 'string',
                        'required' => $v2['required'],
                        'default' => $v2['eg'],
                    ];
                }

                $bodyParams = [];
                $body_params = $v1['inputs']['body_params'];
                $body_params = ApiHelper::rmNode($body_params);
                if (count($body_params)) {
                    $schema = [];
                    foreach ($body_params as $k2 => $v2) {
                        $schema[$k2] = [
                            'description' => $v2['des'],
                            'type' => 'string',
                            'required' => $v2['required'],
                            'example' => $v2['eg'],
                        ];
                    }
                    $bodyParams[] = [
                        'in' => 'body',
                        'name' => $k2,
                        'description' => $v2['des'],
                        'required' => true,
                        // 'schema' => $schema,
                        'schema' => [
                            'title' => sprintf('object(%s /%s%s/%s?', $v1['method'], $k, $pathTag, $k1),
                            "type" => "object",
                            "properties" => $schema,
                        ],
                    ];
                }

                $inputParams = array_merge($pathParams, $queryParams, $bodyParams);

                // var_dump($inputParams);exit;

                // $pathName = '/demo/{id}';
                $pathName = sprintf('/%s%s/%s', $k, $pathTag, $k1);
                $path[$v1['method']] = [
                    'tags' => [$k],
                    'description' => $v['description'],
                    'operationId' => $k . ' '. $pathName,
                    'parameters' => $inputParams,
                ];


                $paths[$pathName] = $path;
            }

            // var_dump($inputParams);exit;



            // $paths = [];
            // $pathData = [];
            // $pathOneData = [];
            // $pathPre = sprintf('/%s/', ApiHelper::uncamelize($k,$separator='-'));
            // $pathOnePre = sprintf('%s/{id}/', $pathPre);
            
            // $pathsKey = array_keys($v['paths']);
            // if (in_array('index', $pathsKey)) {
            //     $paths[$pathPre]['get'] = [
            //         'controllers' => $k,
            //         'description' => $v['description'],
            //         'operationId' => sprintf('%sController.Get All', $k),
            //         'parameters' => $inputParams['index'],
            //     ];
            // }
            // if (in_array('create', $pathsKey)) {
            //     $paths[$pathPre]['post'] = [
            //         'controllers' => $k,
            //         'description' => $v['description'],
            //         'operationId' => sprintf('%sController.Post', $k),
            //         'parameters' => $inputParams['create'],
            //     ];
            // }
            // if (in_array('view', $pathsKey)) {
            //     $paths[$pathOnePre]['get'] = [
            //         'controllers' => $k,
            //         'description' => $v['description'],
            //         'operationId' => sprintf('%sController.Get One', $k),
            //         'parameters' => $inputParams['view'],
            //     ];
            // }
            // if (in_array('update', $pathsKey)) {
            //     $paths[$pathOnePre]['put'] = [
            //         'controllers' => $k,
            //         'description' => $v['description'],
            //         'operationId' => sprintf('%sController.Put', $k),
            //         'parameters' => $inputParams['update'],
            //     ];
            // }
            // if (in_array('delete', $pathsKey)) {
            //     $paths[$pathOnePre]['delete'] = [
            //         'controllers' => $k,
            //         'description' => $v['description'],
            //         'operationId' => sprintf('%sController.Delete', $k),
            //         'parameters' => $inputParams['delete'],
            //     ];
            // }
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
