<?php
    $asset = myzero1\restbyconf\components\swagger\SwaggerAsset::register($this);

    $js = <<<'js'
    window.onload = function() {
      // Begin Swagger UI call region
      const ui = SwaggerUIBundle({
        url: "https://petstore.swagger.io/v2/swagger.json",
        dom_id: 'body',
        deepLinking: true,
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIStandalonePreset
        ],
        plugins: [
          SwaggerUIBundle.plugins.DownloadUrl
        ],
        layout: "StandaloneLayout"
      })
      // End Swagger UI call region

      window.ui = ui
    }
js;

$this->registerJs($js);
?>

<style type="text/css">
    body{
        padding: 0;
        margin: 0;
    }
</style>

