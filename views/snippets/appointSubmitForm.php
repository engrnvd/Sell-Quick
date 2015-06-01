<form id="bookingForm" action="<?=Yii::$app->params['baseUrl']?>confirmation" method="post">
    <input type="hidden" id="appointmentDate" name="appointmentDate">
    <input type="hidden" id="appointmentTime" name="appointmentTime">
    <input type="hidden" id="status" name="status">
    <button type="submit" id="btn-booking" name="submit-booking" class="btn-booking">Submit Your Booking</button>
</form>
