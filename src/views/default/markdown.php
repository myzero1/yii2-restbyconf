<?php
	\yii\web\YiiAsset::register($this);
	\yii\bootstrap\BootstrapAsset::register($this);
?>
<div class="container">
	<div id="doc-sidebar"></div>
	<div id="doc-body"><?= $markdownHtml?></div>
</div>


<style type="text/css">
	#doc-sidebar{
	    width: 300px;
	    border-right: 2px solid #aaa;
	    height: 100vh;
	    position: fixed;
	    overflow: auto;
	    background: #fff;
    	padding-left: 10px;
	}
	#doc-sidebar a{
		white-space: nowrap;
	}
	#doc-body{
		padding-left: 320px;
	}
	
</style>

<?php
$js = <<<'JS'
	var sidebarObj = $('#doc-body').children('h2').first();
	sidebar = sidebarObj.html() + sidebarObj.next().html();

	$('#doc-sidebar').html(sidebar);

	console.log(sidebar);
JS;

$this->registerJs($js);

?>
