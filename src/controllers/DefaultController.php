<?php

namespace myzero1\restbyconf\controllers;

use yii\web\Controller;
use Yii;

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
        $swaggerPath = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/swagger.json');
        $swaggerData = file_get_contents($swaggerPath);

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
