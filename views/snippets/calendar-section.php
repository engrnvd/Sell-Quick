<div id="calendar-section"  class="box-body">

    <p class="instruction">Please select the best appointment time and date for you in the calendar below:</p>
    <br>

    <div class="col-lg-6 col-md-6 col-sm-6">

        <div id='jqxcalendar'></div>

        <div class="clear"></div>

    </div><!--col md sm 6 6-->

    <div class="col-lg-6 col-md-6 col-sm-6">

        <span id="selected-date-heading"><?=date("D M d Y")?></span>

        <?php require_once __DIR__."/tiny-carousel.php"; ?>

    </div><!--col md sm 6 6-->

    <div class="clear"></div>

</div><!--box body-->

<div class="clear"></div>