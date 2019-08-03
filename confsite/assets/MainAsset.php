<?php
namespace confsite\assets;

class MainAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@confsite/views/myasset';
    public $css = [
		'css/font-face.css',
		'vendor/font-awesome-4.7/css/font-awesome.min.css',
		'vendor/font-awesome-5/css/fontawesome-all.min.css',
		'vendor/mdi-font/css/material-design-iconic-font.min.css',
		'vendor/bootstrap-4.1/bootstrap.min.css',
		'vendor/animsition/animsition.min.css',
		'vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css',
		'vendor/wow/animate.css',
		'vendor/css-hamburgers/hamburgers.min.css',
		'css/theme.css',

    ];
	public $js = [
		//'js/jquery-3.2.1.min.js',
		'vendor/jquery-3.2.1.min.js',
		'vendor/jquery-3.2.1.min.js',
		'vendor/bootstrap-4.1/popper.min.js',
		'vendor/bootstrap-4.1/bootstrap.min.js',
		'vendor/slick/slick.min.js',
		'vendor/wow/wow.min.js',
		'vendor/animsition/animsition.min.js',
		'vendor/bootstrap-progressbar/bootstrap-progressbar.min.js',
		'vendor/counter-up/jquery.waypoints.min.js',
		'vendor/counter-up/jquery.counterup.min.js',
		'vendor/circle-progress/circle-progress.min.js',
		'vendor/perfect-scrollbar/perfect-scrollbar.js',
		'js/main.js'
		
	];

    public $depends = [
        //'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
		'djabiev\yii\assets\AutosizeTextareaAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];

}
