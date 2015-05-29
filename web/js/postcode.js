$(document).ready(function() {
    // variables
    var postcode = $('.postcode'),
        postcodeVal =  postcode.val();

    // initially disable the address drop-down
    $('#address').attr("disabled", "disabled");// adjust loader-image
    $(".loader-img").parent().css("position","relative");

    // call the function if value is not empty on page load (happens in lp-apt)
    if( postcodeVal != undefined && postcodeVal.length > 0 ){ fetchAddresses(postcode); }

    // bind the function
    postcode.on('input', function () { fetchAddresses( $(this) ); } );

    function fetchAddresses ($postcode) {
        // variables:
        // remoteUrl is the url from to which the ajax request is made
        // For consistency b/w js and php, postCodeChangeHandler comes from views/layout/header-common.php
        // You can specify your own
        var remoteURL = postCodeRequestUrl;
        //var $postcode = $(this);
        //if( !$postcode.length ){ $postcode = $('.postcode'); console.log($postcode) }
        var postcode = $postcode.val();
        var count = postcode.length;
        // rtype is used in express estimate solution
        // not required here (i.e. LP-APT)
        var rtype = $("#rtype").val();
        var addressIp = $postcode.parents(".valuationForm").find('.address');
        var addressParentDiv = addressIp.parents(".address-parent-div");
        var loader = $postcode.parents(".valuationForm").find(".loader-img");

        // capitalize postcode
        $postcode.val( formatPostcode(postcode) );

        if ( count >= 5 && isValidPostcode(postcode) )
        {
            $postcode.css('border', ''); // remove error
            loader.show();
            $.ajax({
                type: 'post',
                url: remoteURL,
                data: 'method=search&postcode=' + encodeURIComponent(postcode) + '&type=' + encodeURIComponent(rtype),
                dataType: 'html',
                success: function(data) {
                    if (data.length > 0) {
                        var jsonData = JSON.parse(data);
                        if (jsonData != null)
                        {
                            addressIp.slideDown(200);
                            addressParentDiv.slideDown(200);
                            addressIp.empty();
                            loader.slideUp(200);
                            addressIp.removeAttr('disabled');
                            for (var i = 0; i < jsonData.length; i++)
                            {
                                addressIp.append('<option value="' + jsonData[i]['HouseNumber'] + '">' + jsonData[i]['Address'] + '</option>');
                            }
                        }
                        if (jsonData == null || jsonData == '')
                        {
                            loader.hide();
                            addressIp.hide();
                            addressIp.empty();
                            addressIp.attr("disabled", "disabled");
                            $postcode.css('border', '2px solid red');
                        }
                    }
                }
            });
        } else if (count < 5) {
            addressIp.attr("disabled", "disabled");
            addressIp.hide();
            loader.hide();
        } else if ( count >= 5 && !isValidPostcode(postcode) ){
            $postcode.css('border', '2px solid red');
            addressIp.attr("disabled", "disabled");
            addressIp.hide();
        }else{
            addressIp.attr("disabled", "disabled");
            addressIp.hide();
        }
    }

    /***
     * Valid Postcode Patterns:
     * AA9A9AA
     * A9A9AA
     * A99AA
     * A999AA
     * AA99AA
     * AA999AA
     * Where:
     * A = anything from A-Z
     * 9 = anything from 0-9
     ***/
    function isValidPostcode(postcodeString) {
        var result = false;
        postcodeString = postcodeString.replace( /\s/ , "" );
        var regexArray = [
            /^[A-Z]{1,2}[0-9][A-Z][0-9][A-Z]{2}$/i,    // AA9A9AA or A9A9AA
            /^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/i          // A99AA or A999AA or AA99AA or AA999AA
        ];

        for( var $i = 0, len = regexArray.length; $i < len; $i ++ ) {
            if( regexArray[$i].test(postcodeString) )
            {
                result = true;
                //console.log("Following regex test passed: "+regexArray[$i])
            }
            //else{ console.log("Following regex test failed: "+regexArray[$i]) }
        }

        return result;
    }

    /**
     * changes the parameter string to upper case and removes spaces
     */
    function formatPostcode(postcodeString) {
        return postcodeString.toUpperCase();
    }

});