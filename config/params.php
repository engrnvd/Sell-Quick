<?php

// default parameters for production environment
$params = [
    'siteTitle' => 'Sell Quick',
    'baseUrl' => '########',
];
$params['assetsDir'] = $params['baseUrl'].'web/';
$params['enableConversionCodes'] = true;
$params['moreAboutSQRedirectPage'] = "http://www.expressestateagency.co.uk/LPAPT/web/lpapt2a#select-slot";

// mailConfig
$params['mail'] = [
    'apiKey' => 'iWXEJKCA9DGqgNXxP__oJA', // naveed.malik
    'fromEmail' => 'test@dl.com',
];

// alter parameters in different environments
if(YII_ENV_TEST)
{
    $params['enableConversionCodes'] = false;
    $params['assetsDir'] = "http://104.238.102.6/~rawal/LP/SQ/sq-29-05-15/web/";
    $params['baseUrl'] = $params['assetsDir']."index.php/";
}
elseif(YII_ENV_DEV)
{
    $params['enableConversionCodes'] = false;
    $params['baseUrl'] = 'http://localhost/2015-05-08-sq-lp/sell-quick-automation/';
    $params['assetsDir'] = $params['baseUrl'].'web/';
    $params['moreAboutSQRedirectPage'] = "http://localhost/2015-05-20-lp-apt/automation/lpapt2a#select-slot";
}

$params['postCodeRequestUrl'] = "http://www.expressestateagency.co.uk/exprestimatesoln/addresess";
$params['moreAboutSQPage'] = $params['baseUrl'].'more-about-quick-sale';

return $params;