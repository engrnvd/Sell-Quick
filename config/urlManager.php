<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/14/2015
 * Time: 6:19 PM
 */

return
    [
    'class' => 'yii\web\UrlManager',
    // Disable index.php
    'showScriptName' => false,
    // Disable r= routes
    'enablePrettyUrl' => true,
    'baseUrl' => $params['baseUrl'],
    'rules' => [
        '<action>' => 'site/<action>',
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ],
];