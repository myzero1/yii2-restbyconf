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
            $noPath = ['create', 'index', ];
            $noQuery = ['create', 'update', 'view', 'delete', ];
            $noBody = ['index', 'view', 'delete', ];
            foreach ($pathsSource as $k1 => $v1) {
                $path = [];
                $pathTag = '';

                $pathParams = [];
                if (!in_array($k1, $noPath)) {
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
                }

                $queryParams = [];
                if (!in_array($k1, $noQuery)) {
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
                }

                $bodyParams = [];
                if (!in_array($k1, $noBody)) {
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
                                'title' => sprintf('bodyInputs(%s /%s%s/%s?', $v1['method'], $k, $pathTag, $k1),
                                "type" => "object",
                                "properties" => $schema,
                            ],
                        ];
                    }
                }

                $inputParams = array_merge($pathParams, $queryParams, $bodyParams);

                $outputParams = [];
                $path_outputs = $v1['outputs'];
                $path_outputs = ApiHelper::rmNode($path_outputs);

                $dataStr = json_encode($path_outputs);

                $outputParams['200'] = [
                    'description' => 'outputs',
                    'type' => 'string',
                    'example' => $dataStr,
                ];

                // var_dump($inputParams);exit;

                // $pathName = '/demo/{id}';
                $pathName = sprintf('/%s%s/%s', $k, $pathTag, $k1);
                // var_dump($pathName);exit;
                $path[$v1['method']] = [
                    'tags' => [$k],
                    'description' => $v['description'],
                    'operationId' => $k . ''. str_replace('/', '-', str_replace('}', '', str_replace('{', '', $pathName))),
                    'parameters' => $inputParams,
                    'responses' => $outputParams,
                ];

                if ($k1 == 'create') {
                    $pathName = sprintf('/%s', $k);
                    $paths[$pathName]['post'] = $path[$v1['method']];
                } else if ($k1 == 'index') {
                    $pathName = sprintf('/%s', $k);
                    $paths[$pathName]['get'] = $path[$v1['method']];
                } else if ($k1 == 'update') {
                    $pathName = sprintf('/%s/{id}', $k);
                    $paths[$pathName]['put'] = $path[$v1['method']];
                } else if ($k1 == 'view') {
                    $pathName = sprintf('/%s/{id}', $k);
                    $paths[$pathName]['get'] = $path[$v1['method']];
                } else if ($k1 == 'delete') {
                    $pathName = sprintf('/%s/{id}', $k);
                    $paths[$pathName]['delete'] = $path[$v1['method']];
                } else {
                    $paths[$pathName] = $path;
                }

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
