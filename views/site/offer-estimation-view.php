<section>
    <div class="col-lg-6 col-sm-6 padding0">
        <div class="section1-left after dark-blue-bg text-center">
            <h2><span><?=$formData['fullName']?>,</span> <br />
                your personal offer estimation</h2>
            <p>Based on your valuation of <strong>£ <?=$estimatedPropertyValue?></strong> <br />
                on your property in <strong><?=$formData['postcode']?>,</strong> <br />
                here are the results of our Offer Calculator...</p>
        </div><!--section1 left-->
    </div><!--col lg sm 6-->
    <div class="col-lg-6 col-sm-6 padding0">
<!--        <div class="section1-right map-right padding0 text-center">-->
            <iframe width="100%" height="553px" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=<?=$formData['postcode']?>%2C%20United%20Kingdom&key=AIzaSyCUv8spqL1tzTuewXOXzIG1X7Nod1ua_3Y"></iframe>
<!--        </div><!--section1 left-->
    </div><!--col lg sm 6-->
    <div class="clear"></div>
</section><!--section 1-->

<section class="benefits-gurantees">
    <div class="container">
        <div class="light-bg">
            <div class="outer-box">
                <h2>Option 1 - Quick sale estate agency solution from:</h2>
                <br />
                <div class="col-lg-12 padding0">
                    <div class="col-lg-3 col-sm-3 padding-left0 margin-top50 mobile-padding0">
                        <span><img src="<?=Yii::$app->params['assetsDir']?>images/eea-logo.png" class="img-responsive" alt="" /></span>
                        <p>Express Estate Agency are an affiliated partner company</p>
                    </div><!--col lg sm 2 3-->
                    <div class="col-lg-4 col-sm-4 margin-top20 text-center mobile-padding0">
                        <div class="price-tag">
                            <h4>Estimation</h4>
                            <p>
                                Selling price<br/>
                                <span>£<?=($estimatedPropertyValue * 0.98)?> - £<?=$estimatedPropertyValue?></span>
                            </p>
                        </div><!--price tag-->
                    </div><!--col lg sm 2 3-->
                    <div class="col-lg-5 col-sm-5 pull-right padding-right0 mobile-padding0">
                        <div class="list-style2">
                            <h2 class="heading-blue">Recommended option for you <img src="<?=Yii::$app->params['assetsDir']?>images/round-tick.png"/></h2>
                            <p style="font-size:18px; font-weight:bold; padding:10px 0 0 0;">Time to sell = 30 days</p>
                            <ul>
                                <li>Commitment within days, completion within weeks</li>
                                <li>No more wasted time, uncertainty, stress or hassle</li>
                                <li>Binding written assurances for your protection</li>
                                <li>No valuation or Estate Agency fees</li>
                                <li>Flexible, tailor-made solutions</li>
                                <li>No false promises</li>
                                <li>No chain, no public viewings and a confidential sale</li>
                                <li>No legal fees (up to £1000 paid on completion)</li>
                                <li>Purchase timeframes tailored to suit you</li>
                            </ul>
                            <div class="clear"></div>
                        </div><!--list style-->
                    </div><!--col lg sm 7-->
                    <div class="clear"></div>
                </div><!--col lg 12-->
                <div class="col-lg-12 padding0 margin-top20">
                    <div class="col-lg-1 col-sm-1 padding-left0 hidden-xs">
                        <img src="<?=Yii::$app->params['assetsDir']?>images/arrow-right-point.png" class="img-width" alt="" />
                    </div><!--col lg 2 2-->
                    <div class="col-lg-10 col-sm-10 padding0">
                        <a href="<?=Yii::$app->params['moreAboutSQPage']?>" target="_blank" class="orange-btn">
                            Click here to find out more about Express Estate Agency’s Quick Sale Option
                        </a>
                    </div><!--col lg 8-->
                    <div class="col-lg-1 col-sm-1 padding-right0 text-right hidden-xs">
                        <img src="<?=Yii::$app->params['assetsDir']?>images/arrow-left-point.png" class="img-width" alt="" />
                    </div><!--col lg 2 2-->
                    <div class="clear"></div>
                </div><!--col lg 12-->
                <div class="clear"></div>
            </div><!--outer-box-->
        </div><!--light bg-->
    </div><!--container-->
</section><!--section 2-->

<section class="grey-bg">
    <div class="container">
        <h2 style="text-align:left; font-size:36px; text-transform:inherit !important;">Option 2 - Cash offer for your property from:</h2>
        <div class="col-lg-12 padding0 margin-top50">
            <div class="col-lg-3 col-sm-3 padding-left0 margin-top50">
                <span><img src="<?=Yii::$app->params['assetsDir']?>images/sq-logo.png" class="img-width" alt="" /></span>
            </div><!--col lg sm 2 3-->
            <div class="col-lg-4 col-sm-4 margin-top20 text-center mobile-padding0">
                <div class="price-tag">
                    <h4>Estimation</h4>
                    <p>
                        Selling price<br />
                        <span>£<?=($estimatedPropertyValue * 0.8)?> - £<?=($estimatedPropertyValue * 0.85)?></span>
                    </p>
                </div><!--price tag-->
            </div><!--col lg sm 2 3-->
            <div class="col-lg-5 col-sm-5 pull-right padding-right0 mobile-padding0">
                <div class="list-style3">
                    <h2 class="heading-blue">Not recommended for you <img src="<?=Yii::$app->params['assetsDir']?>images/round-cross.png"/></h2>
                    <p style="font-size:18px; font-weight:bold; padding:10px 0 0 0;">Time to sell = 7 days</p>
                    <ul>
                        <li>Based on the estimated value of your property, the location and your reason for selling.  We do not believe that this option is best for you </li>
                    </ul>
                    <div class="clear"></div>
                </div><!--list style-->
            </div><!--col lg sm 7-->
            <div class="clear"></div>
        </div><!--col lg 12-->
    </div><!--container-->
    <br /><br /><br /><br />
</section><!--section 3-->


<?php include_once __DIR__."/../snippets/modal-recomended-option.php" ?>

<?php if(Yii::$app->params['enableConversionCodes'])
{ require_once __DIR__."/../snippets/conversation-scripts/include_conversion_codes.php"; }
?>

<script>
window.onload = function () {
    setTimeout( function(){ $("#recommended-option-modal").modal('show'); }, 3000 );
};
</script>