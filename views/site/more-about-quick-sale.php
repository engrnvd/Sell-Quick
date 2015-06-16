<?php

/*
 * Following form fields are expected by LP-APT Page:
 * postcode
 * address
 * propertytype
 * bedrooms
 * fullname
 * planning-sell
 * source
 * testMode
 * lpType
 * lpSubType
 * viaJs
 *
 **/
$formData['propertytype'] = "";
$formData['bedrooms'] = "";
$formData['planning-sell'] = "";
$formData['source'] = "Sell-Quick";
$formData['testMode'] = "";
$formData['lpType'] = "2a";
$formData['lpSubType'] = "";
$formData['lpSubType'] = "";
$formData['viaJs'] = "true";
//pr($formData);
?>
<form id="property-info-form" action="<?=Yii::$app->params['moreAboutSQRedirectPage']?>" method="post">
    <?=hiddenInputsForArray($formData);?>
    <input type="submit" name="submit" id="submit" style="opacity: 0"/>
</form>

<script src="<?=Yii::$app->params['assetsDir']?>js/jquery.min.js"></script>
<script>
    $(function () {
        $("#address").removeAttr("disabled");
        $("#submit").trigger("click");
    });
</script>

