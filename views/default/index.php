<?php

//assets from ph base repo
$cssAnsScriptFilesTheme = array(
	// SHOWDOWN
	'/plugins/showdown/showdown.min.js',
	//MARKDOWN
	'/plugins/to-markdown/to-markdown.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, Yii::app()->request->baseUrl);

//gettting asstes from parent module repo
$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getModule( Yii::app()->params["module"]["parent"] )->getAssetsUrl() );
?>

<style type="text/css">
	h1, h2, h3 {
		background-color: #eee; 
		padding:10px; 
		border:3px solid #ccc; 
		margin: 10px;
	}
	#doc {
		margin: 30px;
	}
</style>

<h1 style="">
	<img height=50 src="<?php echo Yii::app()->getModule( Yii::app()->params["module"]["parent"] )->getAssetsUrl()?>/images/CO.png">
	<img height=50 src="<?php echo $this->module->assetsUrl?>/images/logo.png">
	Co.Tools Module
</h1>

<div id="doc"></div>

<script type="text/javascript">

$(document).ready(function() { 
	getAjax('', baseUrl+'/'+moduleId+'/default/doc',
		function(data){ 
			descHtml = dataHelper.markdownToHtml(data); 
			$('#doc').html(descHtml);
		},"html");
});

</script>
