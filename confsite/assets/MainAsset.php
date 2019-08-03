<?php
namespace confsite\assets;

class MainAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@confsite/views/myasset';
    public $css = [
		'vendor/bootstrap/css/bootstrap.min.css',
		'vendor/fontawesome-free/css/all.min.css',
		'vendor/simple-line-icons/css/simple-line-icons.css',
		'google/css.css',
		'css/landing-page.min.css'

    ];
	public $js = [
		//'js/jquery-3.2.1.min.js',
		'vendor/jquery/jquery.min.js',
		'vendor/bootstrap/js/bootstrap.bundle.min.js',
		
	];

    public $depends = [
        //'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
		'djabiev\yii\assets\AutosizeTextareaAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];

}
