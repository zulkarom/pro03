<?php
namespace confmanager\assets;
class ManagerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@confmanager/views/manager_asset';
    public $css = [
		'vendor/bootstrap/css/bootstrap.min.css',
		'vendor/font-awesome/css/font-awesome.min.css',
		'vendor/linearicons/style.css',
		'vendor/chartist/css/chartist-custom.css', // not really
		'css/main.css',
    ];
	public $js = [
		//'vendor/jquery/jquery.min.js',
		'vendor/bootstrap/js/bootstrap.min.js',
		'vendor/jquery-slimscroll/jquery.slimscroll.min.js',
		'vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js',
		'vendor/chartist/js/chartist.min.js',
		'scripts/klorofil-common.js'

		
	];
    public $depends = [
        //'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
		'djabiev\yii\assets\AutosizeTextareaAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}