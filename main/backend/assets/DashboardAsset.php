<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */         
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/AdminLTE.css',
        'css/skins/_all-skins.min.css',
        'css/blue.css',
        'css/site.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
        'plugins/morris/morris.min.js',
        'plugins/knob/jquery.knob.js',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.js',
        'js/app.min.js',
        'js/pages/dashboard.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
