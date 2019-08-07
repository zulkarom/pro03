<?php
namespace confvalley\assets;

class MainAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@confvalley/views/myasset';
    public $css = [
		'lib/bootstrap/css/bootstrap.min.css',
		'lib/font-awesome/css/font-awesome.min.css',
		'lib/animate/animate.min.css',
		'lib/venobox/venobox.css',
		'lib/owlcarousel/assets/owl.carousel.min.css',
		'css/style.css',

    ];
	public $js = [
		//'lib/jquery/jquery.min.js',
		'lib/jquery/jquery-migrate.min.js',
		'lib/bootstrap/js/bootstrap.bundle.min.js',
		'lib/easing/easing.min.js',
		'lib/superfish/hoverIntent.js',
		'lib/superfish/superfish.min.js',
		'lib/wow/wow.min.js',
		'lib/venobox/venobox.min.js',
		'lib/owlcarousel/owl.carousel.min.js',
		'contactform/contactform.js',
		'js/main.js',
		
	];

    public $depends = [
        //'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
		'djabiev\yii\assets\AutosizeTextareaAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];

}
