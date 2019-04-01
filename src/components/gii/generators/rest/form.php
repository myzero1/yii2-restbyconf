<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

use kdn\yii2\JsonEditor;

?>
<div class="rest-form">
<?php
    echo $form->field($generator, 'conf')->widget(
        '\kdn\yii2\JsonEditor',
        [
            'clientOptions' => ['modes' => ['code', 'tree']],
        ]
    );
?>
</div>
