<?php

// default parameters for production environment
$params = [
    'siteTitle' => 'Sell Quick',
    'baseUrl' => '########',
];
$params['assetsDir'] = $params['baseUrl'].'web/';
$params['enableConversionCodes'] = true;

// alter parameters in different environments
if(YII_ENV_TEST)
{
    $params['enableConversionCodes'] = false;
    $params['assetsDir'] = '########';
    $params['baseUrl'] = $params['assetsDir']."index.php/";
}
elseif(YII_ENV_DEV)
{
    $params['enableConversionCodes'] = false;
    $params['baseUrl'] = 'http://localhost/2015-05-08-sq-lp/sell-quick-automation/';
    $params['assetsDir'] = $params['baseUrl'].'web/';
}

$params['postCodeRequestUrl'] = "http://www.expressestateagency.co.uk/exprestimatesoln/addresess";
$params['moreAboutSQPage'] = $params['baseUrl'].'more-about-quick-sale';


return $params;