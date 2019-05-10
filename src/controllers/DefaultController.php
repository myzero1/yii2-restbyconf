<?php

namespace myzero1\restbyconf\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Url;
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
        return $this->redirect(['/gii/rest']);
        // return $this->render('index');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSwagger()
    {
        $mId = Yii::$app->request->get('mId', '');
        $url = Url::to([sprintf('/%s/default/swagger-json', $this->module->id), 'mId' => $mId]);
        return $this->renderAjax('swagger', ['url' => $url]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSwaggerJson()
    {
        $mId = Yii::$app->request->get('mId', '');
        $swaggerData = ApiHelper::getApiConf($mId);
        $json = json_decode($swaggerData, true)['json'];
        $oldcontrollers = $json['controllers'];
        $oldcontrollers = ApiHelper::rmNode($json['controllers']);
        $controllers = [];
        $actions = [];
        $paths = [];
        $securities = [
            'queryParamAuth' => [
                "description" => "Uri eg: 'demo?token=myzero1_123456'",
                "type" => "apiKey",
                "in" => "query",
                "name" => "token",
            ],
            'httpBasicAuth' => [
                "description" => "Header eg: 'authorization: Basic bXl6ZXJvMToxMjM0NTY='",
                "type" => "basic",
                "in" => "query",
                "name" => "authorization",
            ],
            'httpBearerAuth' => [
                "description" => "Value eg: 'Bearer 123456';Header eg: 'authorization: Bearer 123456'",
                "type" => "apiKey",
                "in" => "header",
                "name" => "authorization",
            ],
            'noAuthenticator' => [],
        ];
        $securityKey = $json['mySecurity']['security'];
        $securityVal = $securities[$securityKey];
        $securityExclude = $json['mySecurity']['exclude'];

        foreach ($oldcontrollers as $k => $v) {
            $k = ApiHelper::uncamelize($k, '-');
            $controller = [];
            $controller['name'] = $k;
            $controller['description'] = $v['description'];
            $controllers[] = $controller;

            $inputParams = [];
            $pathsSource = ApiHelper::rmNode($v['actions']);
            $noPath = ['create', 'index',];
            $noQuery = ['create', 'update', 'view', 'delete',];
            $noBody = ['index', 'view', 'delete',];
            foreach ($pathsSource as $k1 => $v1) {
                $path = [];
                $pathTag = '';

                $pathParams = [];
                $queryParams = [];
                $bodyParams = [];
                $path_params = $v1['inputs']['path_params'];
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

                $query_params = $v1['inputs']['query_params'];
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

                $body_params = $v1['inputs']['body_params'];
                if (count($body_params)) {
                    $schema = [];
                    $bodyParamsRequired = false;
                    foreach ($body_params as $k2 => $v2) {
                        $schema[$k2] = [
                            'description' => $v2['des'],
                            'type' => 'string',
                            'required' => $v2['required'],
                            'example' => $v2['eg'],
                        ];

                        if ($v2['required']) {
                            $bodyParamsRequired = true;
                        }
                    }
                    $bodyParams[] = [
                        'in' => 'body',
                        'name' => 'bodyParams',
                        'description' => 'body params description',
                        'required' => $bodyParamsRequired,
                        // 'schema' => $schema,
                        'schema' => [
                            'title' => sprintf('bodyInputs(%s /%s%s/%s?', $v1['method'], $k, $pathTag, $k1),
                            "type" => "object",
                            "properties" => $schema,
                        ],
                    ];
                }

                $inputParams = array_merge($pathParams, $queryParams, $bodyParams);

                /*$vud = [
                    'view',
                    'update',
                    'delete',
                ];
                // $controllerV['defaultPathIdKey'], $controllerV['defaultPathIdRule'], $controllerV['defaultPathIdErrorMsg']);
                if (in_array($k1, $vud)) {
                    $pathParam = [
                        'in' => 'path',
                        'name' => $v['defaultPathIdKey'],
                        'description' => $v['defaultPathIdKey'] . ' description',
                        'type' => 'string',
                        'required' => true,
                        'default' => $v['defaultPathIdVal'],
                    ];
                    array_unshift($inputParams, $pathParam);
                }*/

                $outputParams = [];
                $path_outputs = $v1['outputs'];
                $path_outputs = ApiHelper::rmNode($path_outputs);

                // $dataStr = json_encode($path_outputs);
                $dataStr = json_encode($path_outputs, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);

                $outputParams['200'] = [
                    'description' => 'outputs',
                    'type' => 'string',
                    'example' => $dataStr,
                ];

                // var_dump($inputParams);exit;

                // $pathName = '/demo/{id}';
                $k1 = ApiHelper::uncamelize($k1, '-');
                $pathName = sprintf('/%s%s/%s', $k, $pathTag, $k1);
                // var_dump($pathName);exit;
                $path[$v1['method']] = [
                    'tags' => [$k],
                    'description' => $v1['description'],
                    'summary' => $v1['summary'],
                    'operationId' => $k . '' . str_replace('/', '-', str_replace('}', '', str_replace('{', '', $pathName))),
                    'parameters' => $inputParams,
                    'responses' => $outputParams,
                    // 'security' => [
                    //     [
                    //         'httpBearerAuth' => [],
                    //     ]
                    // ],
                ];

                $mytag = sprintf('%s %s', $v1['method'], $pathName);
                if ($securityKey != 'noAuthenticator') {
                    if (!in_array($mytag, $securityExclude)) {
                        $path[$v1['method']]['security'] = [
                            [
                                $securityKey => $securityVal,
                            ]
                        ];
                    }
                }

                $pathName = str_replace('{controller}', $k, $v1['uri']);
                if ($k1 == 'create') {
                    $paths[$pathName]['post'] = $path[$v1['method']];
                } else if ($k1 == 'index') {
                    $paths[$pathName]['get'] = $path[$v1['method']];
                } else if ($k1 == 'update') {
                    $paths[$pathName]['put'] = $path[$v1['method']];
                } else if ($k1 == 'view') {
                    $paths[$pathName]['get'] = $path[$v1['method']];
                } else if ($k1 == 'delete') {
                    $paths[$pathName]['delete'] = $path[$v1['method']];
                } else {
                    $paths[$pathName] = $path;
                }
            }
        }

        unset($json['controllers']);
        $json['tags'] = $controllers;
        $json['paths'] = $paths;
        if ($securityKey != 'noAuthenticator') {
            $json['securityDefinitions'] = [
                $securityKey => $securityVal,
            ];
        }

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
        $mId = Yii::$app->request->get('mId', '');
        $swaggerData = ApiHelper::getApiConf($mId);
        $json = json_decode($swaggerData, true)['json'];
        $oldcontrollers = $json['controllers'];
        $oldcontrollers = ApiHelper::rmNode($json['controllers']);

        $info = '';
        $table = '';
        $content = '';

        $info .= sprintf("# 1. %s \n", $json['info']['title']);
        $info .= sprintf("* %s \n", $json['info']['description']);
        $info .= sprintf("------ \n");

        $info .= sprintf("> * version:%s \n", $json['info']['version']);
        $info .= sprintf("> * email:%s \n", $json['info']['contact']['email']);
        $info .= sprintf("> * license:[%s](%s) \n\n", $json['info']['license']['name'], $json['info']['license']['url']);
        $info .= sprintf("****** \n");

        $table .= sprintf("\n<a name='1.1' ></a> \n");
        $table .= sprintf("\n## 1.1. Table \n");
        $content .= sprintf("\n## 1.2. Content \n");

        // var_dump($oldcontrollers);exit;
        $i = 0;
        foreach ($oldcontrollers as $oldcontroller => $oldcontrollerV) {
            $i += 1;
            $table .= sprintf("- [1.2.%s. %s](#1.2.%s) \n", $i, $oldcontroller, $i);

            $content .= sprintf("\n<a name='1.2.%s' ></a> \n", $i);
            $content .= sprintf("### 1.2.%s. %s \n", $i, $oldcontroller);
            $content .= sprintf("> [Go table](#1.1) \n\n");
            $content .= sprintf("&nbsp;`Description` \n\n");
            $content .= sprintf("%s \n", $oldcontrollerV['description']);

            $j = 0;
            foreach ($oldcontrollerV['actions'] as $action => $actionsV) {
                $j += 1;
                $table .= sprintf("    - [1.2.%s.%s. %s](#1.2.%s.%s) \n", $i, $j, $action, $i, $j);

                $content .= sprintf("\n<a name='1.2.%s.%s' ></a> \n", $i, $j);
                $content .= sprintf("#### 1.2.%s.%s. %s \n", $i, $j, $action);
                $content .= sprintf("> [Go table](#1.1) \n\n");
                // $content .= sprintf("&nbsp;`summary` \n\n");
                // $content .= sprintf("%s \n\n", $actionsV['summary']);
                // $content .= sprintf("&nbsp;`description` \n\n");
                // $content .= sprintf("%s \n", $actionsV['description']);
                $content .= sprintf("\n&nbsp;`Basic info` \n\n");
                $content .= sprintf("| Items | Detail | \n");
                $content .= sprintf("|-------|:---------:| \n");
                $content .= sprintf("| Summary | %s | \n", $actionsV['summary']);
                $content .= sprintf("| Description | %s | \n", $actionsV['description']);
                $content .= sprintf("| Method | %s | \n", strtoupper($actionsV['method']));
                $content .= sprintf("| Uri | %s/%s | \n", $json['basePath'], $action);
                $content .= sprintf("| ContentType | application/json | \n");
                $content .= sprintf("\n");

                $content .= sprintf("&nbsp; \n\n`Inputs` \n\n");
                if (count($actionsV['inputs']['body_params'])) {
                    $content .= sprintf("&nbsp; \n\n");
                    $content .= sprintf("***Body params*** \n\n");
                    $content .= sprintf("| Name | Des | Required | Eg | Rules | Rrror msg | \n");
                    $content .= sprintf("|-|:-:|:-:|:-:|:-:|:-:| \n");
                    foreach ($actionsV['inputs']['body_params'] as $k => $v) {
                        $content .= sprintf("| %s | %s | %s | %s | %s | %s | \n",
                            $k,
                            $v['des'],
                            intval($v['required']),
                            $v['eg'],
                            $v['rules'],
                            $v['error_msg']
                        );
                    }
                    $content .= sprintf("\n");
                }
                if (count($actionsV['inputs']['path_params'])) {
                    $content .= sprintf("&nbsp; \n\n");
                    $content .= sprintf("***Path params*** \n\n");
                    $content .= sprintf("| Name | Des | Required | Eg | Rules | Rrror msg | \n");
                    $content .= sprintf("|-|:-:|:-:|:-:|:-:|:-:| \n");
                    foreach ($actionsV['inputs']['path_params'] as $k => $v) {
                        $content .= sprintf("| %s | %s | %s | %s | %s | %s | \n",
                            $k,
                            $v['des'],
                            intval($v['required']),
                            $v['eg'],
                            $v['rules'],
                            $v['error_msg']
                        );
                    }
                    $content .= sprintf("\n");
                }
                if (count($actionsV['inputs']['query_params'])) {
                    $content .= sprintf("&nbsp; \n\n");
                    $content .= sprintf("***Query params*** \n\n");
                    $content .= sprintf("| Name | Des | Required | Eg | Rules | Rrror msg | \n");
                    $content .= sprintf("|-|:-:|:-:|:-:|:-:|:-:| \n");
                    foreach ($actionsV['inputs']['query_params'] as $k => $v) {
                        $content .= sprintf("| %s | %s | %s | %s | %s | %s | \n",
                            $k,
                            $v['des'],
                            intval($v['required']),
                            $v['eg'],
                            $v['rules'],
                            $v['error_msg']
                        );
                    }
                    $content .= sprintf("\n");
                }

                $content .= sprintf("&nbsp; \n\n`Outputs` \n\n");
                $content .= sprintf("``` \n");
                $content .= sprintf("%s \n", json_encode($actionsV['outputs'], JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT));
                $content .= sprintf("``` \n");
                $content .= sprintf("\n");
            }
        }


        $markdown = $info . $table . $content;


        // var_dump($markdown);exit;
        $markdownHtml = \yii\helpers\Markdown::process($markdown);
        $markdownHtml = \yii\helpers\Markdown::process($markdown, 'gfm');

        $style = <<<style
        <style>
            table {
                border: 1px solid #ddd;
                width: 100%;
            }
            table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th{
                border: 1px solid #ddd;
                padding: 8px;
                line-height: 1.42857143;
                vertical-align: top;
            }
        </style>

style;
        $markdownHtml = $markdownHtml . $style;

        // return $this->render('markdown', ['markdownHtml' => $markdownHtml]);
        return $this->renderAjax('markdown', ['markdownHtml' => $markdownHtml]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionRest()
    {
        return $this->redirect(['/gii/rest']);
    }
}
