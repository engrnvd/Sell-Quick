
<!-- Modal -->
<div class="modal fade" id="recommended-option-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title padding0 margintop0" id="myModalLabel">Recommended option</h4>
            </div>
            <div class="modal-body">
                <br />
                <a href="#" class="text-center" style="width:100%; float:left;"><img src="<?=Yii::$app->params['assetsDir']?>images/eea-logo.png" alt="" /></a>

                <div class="clear"></div><br />

                <div class="text-center">

                    <p style="font-size:18px;">Time to sell = 30 days</p>

                </div><!--center-->
                <div class="price-tag" style="text-align:center; margin:0 auto;">

                    <h4>Estimation</h4>
                    <p>
                        Selling price<br />
                        <span>£<?=($estimatedPropertyValue * 0.98)?> - £<?=$estimatedPropertyValue?></span>
                    </p>

                </div><!--price tag-->

            </div>
            <div class="modal-footer">

                <a href="<?=Yii::$app->params['moreAboutSQPage']?>" target="_blank" class="orange-btn" style="font-size:15px;">
                    Click here to find out more about Express Estate Agency’s Quick Sale Option
                </a>
            </div>
        </div>
    </div>
</div><!--Modal-->