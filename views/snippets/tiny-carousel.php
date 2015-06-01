<?php
/**
 * Created by Naveed Hassan
 * Date: 4/21/2015
 * Time: 2:08 PM
 */
?>
<div id="slider1">

    <p class="buttons-container"><a class="buttons prev" href="#"></a></p>

    <div class="viewport">
        <ul class="overview">
            <?php
            // from 8:00 to 19:00
            $startTime = 8*60;
            $endTime = 19*60;
            $slotDuration = 60; // in minutes
            $numSlotsPerPage = 6;

            for ( $i = $startTime; $i <= $endTime; $i += $slotDuration*$numSlotsPerPage  ){
                echo "<li class='page'><ul>";
                for ( $j = $i,$limit = $i + $slotDuration*$numSlotsPerPage; $j < $limit; $j += $slotDuration  ){
                    $time = getTimeFromMins($j);
                    echo "<li><span class='time'>{$time}</span><span class='btn-select disclaimer available' data-time='{$time}'>Available</span></li>";
                }
                echo "</ul></li>";
            }

            ?>
        </ul>
    </div>
    <p class="buttons-container"><a class="buttons next" href="#"></a></p>
</div>