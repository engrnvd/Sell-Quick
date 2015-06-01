<?php
/**
 * Created by Naveed ul Hassan
 * Date: 4/20/2015
 * Time: 12:46 PM
 */

use yii\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?> | <?=Yii::$app->params['siteTitle']?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="<?=Yii::$app->params['assetsDir']?>images/favicon.ico" />

    <?php
    // The following script initializes the global variables used throughout javascript
    ?>
    <script>
        var siteBaseUrl = '',
            siteAssetsDir = '',
            actionForPropertyForm = '';
    </script>
    <!--Web Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Chau+Philomene+One' rel='stylesheet' type='text/css'>

    <?php $this->head() ?>
    <link rel="stylesheet" type="text/css" href="<?=Yii::$app->params['assetsDir']?>css/apt2/animate-custom.css">
    <link rel="stylesheet" type="text/css" href="<?=Yii::$app->params['assetsDir']?>css/apt2/custom.css">
</head>
<body>
<div id="wrapper">

    <div class="container">

        <div class="TopHeader">
            <div class="top-left">
                <a href="#" class="fl"><img src="<?=Yii::$app->params['assetsDir']?>images/apt2/logo.jpg" alt=""></a>

                <div class="clear"></div>
            </div><!--col md 4-->
            <div class="Phone-Info hidden-xs">

                <span class="fl margin-top15"><img src="<?=Yii::$app->params['assetsDir']?>images/apt2/phone-icon.png" alt=""></span>
                <div class="Phone-Data">
                    Free phone <span>0800 046 7270</span><br />
                    Mobile friendly <span>0345 073 9679</span><br />
                    <strong>24 hours a day, 7 days a week</strong>
                </div><!--Phone Data-->

            </div><!--Phone-Info-->


            <div class="clear"></div>
        </div><!--Top Header-->

    </div><!--container-->

    <?php $this->beginBody() ?>

    <?= $content ?>

    <div class="Footer-Bg">

        <div class="container">

            <p class="Copy-Rights">Copyright <?=date('Y')?>. All rights reserved. Express Estate Agency Ltd - <br />
                Registered Office: Peter House, Oxford Street, Manchester, M1 5AN - Company No: 07914454</p>

        </div><!--container-->

    </div><!--Footer-Bg-->

    </div><!--wrapper-->


    <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
