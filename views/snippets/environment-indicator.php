<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/20/2015
 * Time: 4:18 PM
 */
// environment indicator =======================================================
if( YII_ENV_TEST || YII_ENV_DEV ) { ?>
    <script>
        var nvdEnvironmentVariable = '<?= YII_ENV_TEST ? "TESTING" : ( YII_ENV_DEV ? "DEVELOPMENT" : "PRODUCTION" )?>';
        var nvdEnvironmentIndicatorMarkup = "<div style='position: fixed; background: #fff; color: #000;bottom: 4px; width: 30%; opacity: 0.8; padding: 0.5em; border-radius: 0 1em 1em 0;'>" +
            "This website is running in " +
            "<span style='font-weight: bold'>"+nvdEnvironmentVariable+"</span>" +
            " environment</div>";
        $("body").append(nvdEnvironmentIndicatorMarkup);
    </script>
<?php } //  ==================================================================== ?>