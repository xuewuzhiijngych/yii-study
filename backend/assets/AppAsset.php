<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'css/bootstrap.min.css?v=3.3.5',
        'css/font-awesome.min.css?v=4.4.0',
        'css/animate.min.css',
        'css/style.min.css?v=4.0.0',
    ];

    public $js = [
        'js/bootstrap.min.js?v=3.3.5'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
