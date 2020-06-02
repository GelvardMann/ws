<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,700|Roboto:300,400,700',
        'css/plugins.css',
        'css/style.css',
        'css/custom.css',
    ];
    public $js = [
        'js/vendor/modernizr-2.8.3.min.js',
        'js/plugins.js',
        'js/main.js',
        'js/custom.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
