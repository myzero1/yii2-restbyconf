<?php
use myzero1\restbyconf\components\rest\ApiHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);

$moduleId = Yii::$app->request->get('mId', '');
$confDataInit = ApiHelper::getApiConf($moduleId);
// $confDataInit = '';

if ($generator->conf) {
    $confData = $generator->conf;
} else {
    $generator->conf = $confDataInit;
    $confData = $confDataInit;
}

if ($generator->position) {
    $position = $generator->position;
} else {
    $position = '["controllers"]';
}

$mId = ApiHelper::getRestModuleName();

$modulesId = ApiHelper::getRestByConfModuleId();
array_unshift($modulesId, '');

$moduleId = Yii::$app->request->get('mId', '');

?>

<style type="text/css">
    .modal.fade.show{
        opacity:1;
    }
    .restbyconfig .navbar-brand{
        line-height: 50px;
        margin-left: 0 !important;
    }
</style>

<div class="rest-form">

    <nav class="navbar navbar-default navbar-restbyconfig" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Selectable modules</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <?php foreach ($modulesId as $k => $v) {
                        $class = $v == $moduleId ? 'active' : '';
                        if ($v != '') {
                            printf('<li class="%s"><a href="%s">%s api</a></li>', $class, Url::to(['/' . Yii::$app->request->getPathInfo(), 'mId' => $v]), $v);
                        } else {
                            printf('<li class="%s"><a href="%s">%s api</a></li>', $class, Url::to(['/' . Yii::$app->request->getPathInfo()]), $v);
                        }
                    } ?>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-default navbar-restbyconfig" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">The other menu of restbyconfig</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <?php 
                        $confDataArry = json_decode($confData, true);
                        $host = $confDataArry['json']['host'];

                        if ($moduleId != '') {
                            $host = 
                            printf('<li><a target="_blank" href="%s">Swagger</a></li>',
                                Url::to([sprintf('/%s/default/swagger', $mId), 'mId' => $moduleId, 'host' => $host]) 
                            );
                            printf('<li><a target="_blank" href="%s">Markdown</a></li>',
                                Url::to([sprintf('/%s/default/markdown', $mId), 'mId' => $moduleId]) 
                            );
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        // echo $form->field($generator, 'position');
        echo $form->field($generator, 'position')->label('')->hiddenInput();
        // echo $form->field($generator, 'conf')->label('Api configuration');
        echo $form->field($generator, 'conf')->label('Api configuration')->hiddenInput();
    ?>

    <div id="jsoneditor"></div>

    <div id="restbyconfoptions" style="display: none;">
        <?= $confData ?>
    </div>
    <div id="restbyconfposition" style="display: none;">
        <?= $position ?>
    </div>
    <div id="overwriting-wrap">
        <span class="overwriting-label" >Allow overwriting of logical files</span>
        <span class="overwriting-button" id="overwriting-on">On</span>
        <span class="overwriting-button" id="overwriting-off">Off</span>
    </div>
</div>

<style type="text/css">
    .default-view-files, #jsoneditor {
        height: 60vh;
        overflow: auto;
        border: solid 1px #aaa;
        padding: 10px;
    }

    .overwriting-label{
        float: left;
        line-height: 30px;
        font-size: 16px;
        color: red;
        padding-right: 20px;
    }
    #overwriting-wrap{
        overflow: hidden;
        padding: 5px 0 20px 0;
    }
    .overwriting-button{
        display: inline-block;
        height: 30px;
        width: 50px;
        float: left;
        padding: 5px 15px;
        cursor: pointer;
        color: #fff;
        opacity: 0.2;
    }
    #overwriting-on{
        background: green;
        border-radius: 10px 0px 0px 10px;
    }
    #overwriting-off{
        background: red;
        border-radius: 0px 10px 10px 0px;
        opacity: 1;
    }
    #form-fields{
        max-width: 100%;
        width: 100%;
    }
    .navbar-restbyconfig{
        position: static;
        padding: 0;
    }
    .navbar-restbyconfig .navbar-brand{
        line-height: 50px;
        margin-left: 0 !important;
        padding-left: 15px;
    }
    .navbar-restbyconfig .container-fluid{
        padding: 0;
    }
    .navbar-restbyconfig .container-fluid, .navbar-restbyconfig .navbar-nav{
    display: initial;
    }
    .navbar-restbyconfig .navbar-brand{
    font-size: 18px;
    }
    h1, .h1{
    font-size: 2.875rem;
    }
</style>

<?php

$js = <<<'JS'
// modules\two_v1\processing\netbar\Index.php
    var reg = new RegExp("processing\\\w+\\\w+.php$");
    // var txt = 'modules\two_v1\processing\authenticator\Join.php';

    $('.overwrite').each(function(){
        var filePath = $(this).children('.file').children('.preview-code').text();

        if(/\\processing\\/.test(filePath)){
            if(!/\\io\\/.test(filePath)){
                $(this).children('.check').children('input').attr("disabled",true);
            }
        }
    });

    $('#overwriting-off').click(function(){
        $('#overwriting-off').css({'opacity':1});
        $('#overwriting-on').css({'opacity':0.2});

        $('.overwrite').each(function(){
            var filePath = $(this).children('.file').children('.preview-code').text();

            if(/\\processing\\/.test(filePath)){
                if(!/\\io\\/.test(filePath)){
                    $(this).children('.check').children('input').attr("disabled",true);
                }
            }
        });
    });

    $('#overwriting-on').click(function(){
        $('#overwriting-on').css({'opacity':1});
        $('#overwriting-off').css({'opacity':0.2});

        $('.overwrite').each(function(){
            var filePath = $(this).children('.file').children('.preview-code').text();

            if(/\\processing\\/.test(filePath)){
                if(!/\\io\\/.test(filePath)){
                    $(this).children('.check').children('input').attr("disabled",false);
                }
            }
        });
    });
JS;

$this->registerJs($js);

?>