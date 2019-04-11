<?php

namespace myzero1\restbyconf\controllers;

use yii\web\Controller;
use Yii;
use myzero1\restbyconf\components\rest\Helper;

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
        $swaggerPath = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/conf.json');
        $swaggerData = file_get_contents($swaggerPath);
        $json = json_decode($swaggerData, true)['json'];
        $oldTags = $json['tags'];
        $tags = [];
        $paths = [];

        foreach ($oldTags as $k => $v) {
            $tag = [];
            $tag['name'] = $k;
            $tag['description'] = $v['description'];
            $tags[] = $tag;

            $inputParams = [];
            foreach ($v['paths'] as $k1 => $v1) {
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

            $path = [];
            $pathData = [];
            $pathOneData = [];
            $pathPre = sprintf('/%s/', Helper::uncamelize($k,$separator='-'));
            $pathOnePre = sprintf('%s/{id}/', $pathPre);
            $pathData[$pathPre]['get'] = [
                'tags' => $k,
                'description' => $v['description'],
                'operationId' => sprintf('%sController.Get All', $k),
                'parameters' => $inputParams['index'],
            ];
            $pathData[$pathPre]['post'] = [
                'tags' => $k,
                'description' => $v['description'],
                'operationId' => sprintf('%sController.Post', $k),
                'parameters' => $inputParams['create'],
            ];
            $pathOneData[$pathOnePre]['get'] = [
                'tags' => $k,
                'description' => $v['description'],
                'operationId' => sprintf('%sController.Get One', $k),
                'parameters' => $inputParams['view'],
            ];
            $pathOneData[$pathOnePre]['put'] = [
                'tags' => $k,
                'description' => $v['description'],
                'operationId' => sprintf('%sController.Put', $k),
                'parameters' => $inputParams['update'],
            ];
            $pathOneData[$pathOnePre]['delete'] = [
                'tags' => $k,
                'description' => $v['description'],
                'operationId' => sprintf('%sController.Delete', $k),
                'parameters' => $inputParams['delete'],
            ];

            $paths['pathPre'] = $pathData[$pathPre];
            $paths['pathOnePre'] = $pathData[$pathOnePre];
        }


        unset($json['tags']);
        $json['tags'] = $tags;
        $json['paths'] = $paths;
        var_dump($json);exit;

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
