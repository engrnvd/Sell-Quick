<section class="process-stepbg">

    <div class="container padding0">

        <h2 class="font-size60">Thank you...</h2>

        <div class="text-center margin-top50">

            <img src="<?=Yii::$app->params['assetsDir']?>images/smile-icon.png" alt="" />

        </div><!--text center-->

        <div class="col-lg-12 padding0">

            <p class="thanks-text">Thank you for submitting your details. One of our team will be <br />

                in-touch shortly with regards to your free valuation <br />

                and offer for your property.</p>

            <div class="clear"></div>

        </div><!--col lg 12-->

    </div><!--container-->

</section><!--section 2-->

<?php if(Yii::$app->params['enableConversionCodes'])
{ require_once __DIR__."/../snippets/conversation-scripts/include_conversion_codes.php"; }
