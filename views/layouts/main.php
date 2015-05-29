<?php
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Sell Quick</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700|Oswald:400,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/x-icon" href="<?=Yii::$app->params['assetsDir']?>images/favicon.ico" />

    <?php
    // The following script initializes the global variables used throughout javascript
    ?>
    <script>
        var postCodeRequestUrl = '<?=Yii::$app->params['postCodeRequestUrl']?>';
    </script>

    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div id="wrapper">

    <div class="topheader navbar-fixed-top">

        <div class="col-lg-3 col-md-3 col-sm-3">

            <a href="<?=Yii::$app->params['baseUrl']?>" class="logo">
                <img src="<?=Yii::$app->params['assetsDir']?>images/sq-logo.png" alt="" />
            </a>

            <div class="clear"></div>

        </div><!--col lg md sm 3-->

        <div class="col-lg-6 col-md-6 col-sm-5 hidden-xs">

            <h1>Sell your property fast - <span style="text-transform:none !important;">Get a <span>FREE</span> valuation and cash offer</span></h1>

            <div class="clear"></div>

        </div><!--col lg md sm 6-->

        <div class="col-lg-3 col-md-3 col-sm-4 padding0 hidden-xs">

            <div class="contant-info">

                <div class="round-bg">

                    <span>Call us now</span>  0800 056 8466

                </div><!--round-bg-->

                <div class="clear"></div>

                <p>Lines open 24 hours a day, 7 days a week</p>

                <div class="clear"></div>

            </div><!--contact info-->

            <div class="clear"></div>

        </div><!--col lg md sm 3-->

        <div class="clear"></div>

    </div><!--top header-->

        <?=$content?>

    <section class="section-footer">

        <div class="container text-center">

            <p>Copyright <?=date("Y")?> SQ Property Investments Ltd. All rights reserved.<br />

                SQ Property Investments Ltd - Head Office: 2nd Floor, 3 Brindleyplace, Birmingham, B1 2JB - Company No: 08768424</p>

        </div><!--container-->

    </section><!--footer section-->

</div><!--wrapper-->

<?php $this->endBody() ?>

<?php require_once __DIR__."/../snippets/environment-indicator.php"; ?>

</body>
</html>
<?php $this->endPage() ?>
