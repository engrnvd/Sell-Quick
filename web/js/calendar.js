/**
 * Created by  Naveed-ul-Hassan Malik on 5/29/2015.
 */
$(function () {

    // select slot functionality
    $(".btn-select").click(btnSelectFunction);

// calendar
    var calendar = $("#jqxcalendar");
    if(calendar.length){
        // instantiate the widget
        calendar.jqxCalendar({ width: '300px', height: '340px', theme: "eea" });
        // disable all dates before today
        var today = new Date(),
            date = today.getDate(),
            month = today.getMonth(),
            year = today.getFullYear();
        calendar.jqxCalendar( 'setMinDate', new Date( year , month , (date+1) ) );
        console.log("Year: "+year);
        console.log("Month: "+month);
        console.log("Date: "+date);
        console.log(new Date( year , month , date ));
        //bind the event
        calendar.bind('valuechanged', updateSlotsAvailability);
    }else{
        console.log("There is no calendar element on the current page.");
    }
    updateSlotsAvailability();

// booking-form validation
    $("#bookingForm").submit(function () {
        if( validateBookingForm() ){
            var $inProgress = "<div class='in-progress' style='margin: 40px 0; padding: 0 40px; font-size: 18px;'>" +
                "<img style='width: 40px; height: 40px; margin-right: 20px' src='"+siteAssetsDir+"/images/loading-new.gif'>" +
                " Please wait while we process your request." +
                "</div>";
            $(this).find(":submit").hide().after($inProgress);
            return true;
        }
        return false;
    });

    function updateSlotsAvailability() {
        // remove already active slots
        removeAlreadySubmittedSlots();
        // get available slots
        //var date = event.args.date,
        var calendar = $('#jqxcalendar');
        var date = calendar.length ? calendar.jqxCalendar('getDate') : new Date();
        var day = date.getDay();
        $("#selected-date-heading").text(date.toDateString());
        // no slots are available for saturday and sunday
        if( day < 1 || day > 5 ){
            $(".disclaimer").addClass("not-available");
        }else{
            $(".disclaimer").removeClass("not-available");
        }
    }

    function validateBookingForm(){
        // there must be a date and time selected
        var date = $("#appointmentDate").val(),
            time = $("#appointmentTime").val(),
            status = $("#status").val();
        if( date == "" || time == "" || status == "" ){
            var error = "<p class='error'>* Please select an appointment date and time first.</p>";
            $("p.error").remove();
            $("#btn-booking").before(error);
            $("p.error").drawAttention();
            return false;
        }
        console.log("The form is valid.");
        console.log( $("#bookingForm").serialize() );
        return true;
    }

    function btnSelectFunction(){
        // variables
        var date,time;
        // make it active
        removeAlreadySubmittedSlots();
        $(this).addClass("active");

        // store the date and time
        if( $(this).hasClass("not-available") )
        { // not-available
            date = "";
            $("#status").val("");
        }
        else if( $(this).hasClass("disclaimer") )
        { // get date from the calendar
            date = getMySqlDate( $('#jqxcalendar').jqxCalendar('getDate') );
            $("#status").val("pending");
        }
        else
        { // it is coming from slots
            date = $(this).data("date");
            $("#status").val("confirmed");
        }
        time = $(this).data("time");
        // set the values
        $("#appointmentDate").val(date);
        $("#appointmentTime").val(time);

        // prevent def. action and event bubbling
        return false;
    }

    function getMySqlDate(dateObject){
        // check validity first
        if( !isValidDate(dateObject) )
        {
            console.log("Error: "+dateObject+" is not a valid date.");
            return dateObject;
        }
        // date is valid, proceed:
        // append the trailing zero to the date or month part, if necessary
        var datePart = dateObject.getDate(),
            monthPart = dateObject.getMonth() + 1;
        if( datePart.toString().length == 1 ){ datePart = "0" + datePart.toString(); }
        if( monthPart.toString().length == 1 ){ monthPart = "0" + monthPart.toString(); }
        // everything done. Return
        return dateObject.getFullYear() + "-" + monthPart + "-" + datePart;
    }

    function isValidDate(d){
        return Object.prototype.toString.call(d) === "[object Date]" && !isNaN( d.getTime() )
    }

    function removeAlreadySubmittedSlots(){
        $("p.error").remove();
        $(".btn-select").removeClass("active");
        $("#appointmentDate").val("");
        $("#appointmentTime").val("");
        $("#status").val("");
    }
});
