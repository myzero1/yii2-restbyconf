<?php
    $asset = myzero1\restbyconf\components\swagger\SwaggerAsset::register($this);
    $swaggerJsonUri = sprintf('/%s/default/swagger-json', $this->context->module->id);
?>

<div id="swagger-content"></div>
<div id="swagger-json-uri" style="display: none"><?=$swaggerJsonUri?></div>