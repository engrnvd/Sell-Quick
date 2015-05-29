<?php
/**
 * Created by Naveed ul Hassan
 * Date: 4/27/2015
 * Time: 3:15 PM
 */
$snippetsDir = __DIR__."/../snippets/";
$this->title = "Set Appointment";

?>
<div class="Service-Bg marign0">

    <div id="select-slot" class="container tablet-padding50">

        <h2>Select one of the available slots below</h2>
        <p>In order to get the most accurate valuation of your property.  One of our Local Property Valuers will need to visit you at the property you are selling.  This valuation visit is completely free of charge and without obligation.</p>

        <div class="Clients-Container">

            <div class="content col-sm-8">

                <div>

                    <div class="during-free-apt-container">
                        <?php require_once __DIR__."/../snippets/during-our-free-appointment.php" ?>
                    </div>

                    <div class="clear"></div>

                    <?php require_once $snippetsDir."calendar-section.php" ; ?>

                    <?php require_once $snippetsDir."appointSubmitForm.php" ; ?>

                </div>

            </div>

            <div class="side-bar col-sm-4">
                <div class="fr padding30 width100">
                    <div style="width:100%; text-align:center;">
                        <img src="<?=Yii::$app->params['assetsDir']?>images/apt2/Review Centre.png" alt=""><div class="clear"></div><br/>
                    </div>
                    <div class="clear"></div>

                    <h4> 13 reasons to use Express Estate Agency</h4>

                    <div class="list-style">

                        <ul>
                            <li>Rated the number 1 estate agent in the UK (Review Centre)</li>
                            <li>No sale, no estate agency fee</li>
                            <li>Currently selling around 300+ properties per month (70+ per week)</li>
                            <li>We help our home sellers get maximum market-value for their property</li>
                            <li>We aim to sell properties within 30 days</li>
                            <li>Regulated by the Property Ombudsman</li>
                            <li>Full coverage of England, Scotland, Wales and Northern Ireland</li>
                            <li>Established company with 160+ employees
                            </li>
                            <li>Only deal with potential Buyers in a position to proceed (no timewasters)</li>
                            <li>Enormous advertising on over 150 websites</li>
                            <li>24/7 Buyer Enquiry line ensuring no offer is ever missed</li>
                            <li>Any property type, any value, any location</li>
                            <li>Have a specialist conveyancing department ensuring sales proceed quickly and smoothly</li>
                        </ul>

                    </div><!--list style-->

                    <div class="clear"></div>
                </div><!--boxstyle-panel-->
            </div>

            <div class="clear"></div>
        </div><!--Clients container-->


    </div><!--container-->
</div><!--Service bg-->