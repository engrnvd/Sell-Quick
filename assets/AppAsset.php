<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/jqwidgets/styles/jqx.base.css',
        'js/jqwidgets/styles/jqx.eea.css',
        'css/tinycarousel.css',
        'css/custom.css',
        'css/developer.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jqwidgets/jqxcore.js',
        'js/jqwidgets/jqxdatetimeinput.js',
        'js/jqwidgets/jqxcalendar.js',
        'js/jqwidgets/globalization/globalize.js',
        'js/tinycarousel.min.js',
        'js/calendar.js',
        'js/postcode.js',
        'js/developer.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => 1,
    ];
}
