$(document).ready(function() {
    var RootURL = postCodeChangeHandler; // postCodeChangeHandler comes from views/layout/header-common.php
    console.log("RootUrl is: "+RootURL);

    // postcode functionality
    $('#address').attr("disabled", "disabled");
    var webServiceURL = RootURL + '/addresess',
        postcode = $('#postcode'),
        postcodeVal =  postcode.val();

    // call the function if value is not empty
    if( postcodeVal != undefined && postcodeVal.length > 0 ){ postcodeFunction(); }
    // bind the function
    postcode.on('change keyup paste mouseup input', postcodeFunction );

    // front end validation
    $("#property-info-form").submit(function () {
        if(!ValidateUserInformation()){
            return false;
        }
    });



// functions go here: =================================

    function postcodeFunction () {
        var postcodeIp = $("#postcode");
        var count = postcodeIp.val().length;
        var postcode = postcodeIp.val();
        var rtype = $("#rtype").val();
        var addressIp = $('#address');
        if (count >= 5)
        {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: webServiceURL,
                data: 'method=search&postcode=' + encodeURIComponent(postcode) + '&type=' + encodeURIComponent(rtype),
                dataType: 'html',
                success: function(data) {
                    if (data.length > 0) {
                        var jsonData = JSON.parse(data);
                        if (jsonData != null)
                        {
                            addressIp.slideDown(200);
                            addressIp.empty();
                            $('#loader').slideUp(200);
                            addressIp.removeAttr('disabled');
                            for (var i = 0; i < jsonData.length; i++)
                            {
                                addressIp.append('<option value="' + jsonData[i]['HouseNumber'] + '">' + jsonData[i]['Address'] + '</option>');
                            }
                        }
                        if (jsonData == null || jsonData == '')
                        {
                            $('#loader').hide();
                            addressIp.hide();
                            addressIp.empty();
                            addressIp.attr("disabled", "disabled");
                        }
                    }
                }
            });
        } else if (count < 5) {
            addressIp.attr("disabled", "disabled");
            addressIp.hide();
            $('#loader').hide();
        }
    }

    function ValidateUserInformation()
    {
        var ValidationResult = true;
        var PropertyType = $('#propertytype').val();
        var BedRooms = $('#bedrooms').val();
        var FullName = $('#fullname').val();
        var EmailAddress = $('#emailaddress').val();
        var PhoneNumber = $('#phonenumber').val();
        var PlanningSell = $('#planning-sell').val();
        var postcode = $('#postcode').val();
        var address = $('#address').val();

        if (postcode == '' || postcode == null)
        {
            $('#postcode').css('border', '2px solid red');
            ValidationResult = false;
        }
        else if (address == '' || address == null) {
            $('#postcode').css('border', '2px solid red');
            ValidationResult = false;
        }
        else
        {
            $('#postcode').css('border', 'none');
        }
        if (PropertyType == 0)
        {
            $('#propertytype').css('border', '2px solid red');
            ValidationResult = false;
        }
        else {
            $('#propertytype').css('border', 'none');
        }
        if (BedRooms == 0)
        {
            $('#bedrooms').css('border', '2px solid red');
            ValidationResult = false;
        }
        else {
            $('#bedrooms').css('border', 'none');
        }
        if (FullName == "" || FullName.trim() == "")
        {
            $('#fullname').css('border', '2px solid red');
            ValidationResult = false;
        }
        else {
            $('#fullname').css('border', 'none');
        }
        if (EmailAddress == "" || EmailAddress.trim() == "")
        {
            $('#emailaddress').css('border', '2px solid red');
            ValidationResult = false;
        }
        else if (echeck(EmailAddress) == false)
        {
            $('#emailaddress').css('border', '2px solid red');
            ValidationResult = false;
        }
        else {
            $('#emailaddress').css('border', 'none');
        }
        if (PhoneNumber == "" || PhoneNumber.trim() == "")
        {
            $('#phonenumber').css('border', '2px solid red');
            ValidationResult = false;
        }
        else if (IsTelephoneNumberValid(PhoneNumber) == false)
        {
            $('#phonenumber').css('border', '2px solid red');
            ValidationResult = false;
        }
        else
        {
            $('#phonenumber').css('border', 'none');
        }
        if (PlanningSell == 0)
        {
            $('#planning-sell').css('border', '2px solid red');
            ValidationResult = false;
        }
        else {
            $('#planning-sell').css('border', 'none');
        }
        if (ValidationResult != true)
        {
            return false;
        }
        else {
            //$('input[type="submit"]').attr('disabled', 'disabled');
            return true;
        }
    }
    function echeck(str)
    {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(str);
    }
    function phonenumber(PhoneNumber)
    {
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        return phoneno.test(PhoneNumber);
    }
    function is_numeric(str)
    {
        return /^ *[0-9\s]+ *$/.test(str);
    }
    function IsNumberHaveFiveConsectiveIncrementalDigits(Number)
    {
        var result = 0;
        for (var i = 0; i < Number.length; i++)
        {
            if (result == 1)
            {
                break;
            }
            for (var j = i; j < (i + 5); j++)
            {
                var First = Number.substr(j, 1);
                var Next = Number.substr((j + 1), 1);
                if (Next != ++First)
                {
                    result = 0;
                    i = j;
                    if (i >= 7)
                    {
                        break;
                    }
                }
                else
                {
                    result = 1;
                }
            }

        }
        return result;
    }
    function IsNumberHaveFiveConsectiveDecrementalDigits(Number)
    {
        var result = 0;
        for (var i = 0; i < Number.length; i++)
        {
            if (result == 1)
            {
                break;
            }
            for (var j = i; j < (i + 5); j++)
            {
                var First = Number.substr(j, 1);
                var Next = Number.substr((j + 1), 1);
                if (Next != --First)
                {
                    result = 0;
                    i = j;
                    if (i >= 7)
                    {
                        break;
                    }
                }
                else
                {
                    result = 1;
                }
            }

        }
        return result;
    }
    function IsThreeOrMorePairsExistConsectivily(Number)
    {
        var result = 0;
        var Rep = 0;
        for (var j = 0; j < Number.length; j++)
        {
            var FirstTwoDigits = Number.substr(j, 2);
            var NextTwoDigits = Number.substr((j + 2), 2);
            if (FirstTwoDigits != NextTwoDigits)
            {
                Rep = 0;
                result = 0;
            }
            else
            {
                Rep++;
                if (Rep == 2)
                {
                    break;
                }
                result = 1;
                j++;
            }
        }
        return result;
    }
    function NumberStart(Number)
    {
        return /^01[\d+]*|^02[0-9]*|^07[0-9]*/.test(Number);
    }
    function is_numberRepetitionFiveTimes(Number)
    {
        return /1{5}|2{5}|3{5}|4{5}|5{5}|6{5}|7{5}|8{5}|9{5}/.test(Number);
    }
    function IsTelephoneNumberValid(Number)
    {
        Number = Number.replace(/ /g, ""); // g for global. will search throughout the Number
        var result = true;
        if (!is_numeric(Number))
        {
            result = false;
        }
        else if (Number.length < 11)
        {
            result = false;
        }
        else if (Number.length > 11)
        {
            result = false;
        }
        else if (!NumberStart(Number))
        {
            result = false;
        }
        //else if (is_numberRepetitionFiveTimes(Number))
        //{
        //    result = false;
        //}
        //else if (IsNumberHaveFiveConsectiveIncrementalDigits(Number))
        //{
        //    result = false;
        //}
        //else if (IsNumberHaveFiveConsectiveDecrementalDigits(Number))
        //{
        //    result = false;
        //}
        else if (IsThreeOrMorePairsExistConsectivily(Number))
        {
            result = false;
        }
        return result;
    }
    function isValidPostcode(p) {
        var postcodeRegEx = /[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i;
        return postcodeRegEx.test(p);
    }
    function formatPostcode(p) {
        if (isValidPostcode(p)) {
            var postcodeRegEx = /(^[A-Z]{1,2}[0-9]{1,2})([0-9][A-Z]{2}$)/i;
            return p.replace(postcodeRegEx, "$1 $2");
        } else {
            return p;
        }
    }

});