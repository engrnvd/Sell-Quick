<?php
if( $_SERVER['HTTP_HOST'] == 'localhost' ){
    defined('YII_ENV') or define('YII_ENV', 'dev');
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}
elseif( $_SERVER['HTTP_HOST'] == '104.238.102.6' ){
    defined('YII_ENV') or define('YII_ENV', 'test');
}
else{
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

// The following code is added by Naveed to load his own php libraries
foreach (glob(__DIR__."/../custom-libs/*.php") as $filename){ require_once $filename; }
//--

//$allowedIPs = [ '101.50.98.115', '::1' ];
////$allowedIPs = "*";
//if( $allowedIPs !== "*" ){
//    $userIp = get_user_ip_address();
//    if( !in_array( $userIp, $allowedIPs ) ){
//        ChromePhp::log($userIp);
//        echo "<h3>Under Development....</h3>";
//        echo "<p><a href='www.dynamologic.com'>www.dynamologic.com</a><p>";
//        exit;
//    }
//}

(new yii\web\Application($config))->run();
