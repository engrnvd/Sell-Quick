<section class="first-section">
    <div class="col-lg-6 col-sm-6 padding0">
        <div class="section1-left text-center">
            <h2>Are you selling your property?</h2>

            <h4>Get a <span>FREE</span> valuation and cash offer</h4>

            <br />

            <img src="<?=Yii::$app->params['assetsDir']?>images/sell-quick-hero.png" alt="" />
        </div><!--section1 left-->
    </div><!--col lg sm 6-->
    <div class="col-lg-6 col-sm-6 padding0">
        <div class="section1-right text-center">
            <div class="padding20">

                <?php new \app\components\ValuationFormWidget($formModel); ?>

            </div><!--padding 20-->
        </div><!--section1 left-->
    </div><!--col lg sm 6-->
    <div class="clear"></div>

</section><!--section 1-->