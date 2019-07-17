<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TmplAsset extends AssetBundle
{
    public $sourcePath = '@backend/views/assets';
    public $css = [
		'vendor/fontawesome-free/css/all.min.css',
		'css/sb-admin-2.css',
		'css/breadcrumb.css'
    ];
	public $js = [
		//"vendor/jquery/jquery.min.js",
		"vendor/bootstrap/js/bootstrap.bundle.min.js",
		"vendor/jquery-easing/jquery.easing.min.js",
		"js/sb-admin-2.min.js",
		"vendor/chart.js/Chart.min.js",
		"js/demo/chart-area-demo.js",
		"js/demo/chart-pie-demo.js"
	];
	
	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
		'djabiev\yii\assets\AutosizeTextareaAsset',
    ];
}
