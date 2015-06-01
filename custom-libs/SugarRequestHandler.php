<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/29/2015
 * Time: 3:57 PM
 */
namespace yii\nvd;

class SugarRequestHandler {
    public $centralUrl = "http://6gvt-nynn.accessdomain.com/spcentralengine/request.action.php";
    public $lead_subject; // email subject
    public $domain; // e.g. eea
    public $devicetype = "desktop";
    public $source; // e.g. lpt
    public $lead_type; // SQ or SQ Priority Lead
    public $leadID = null;
    public $insertSugar = "Yes";
    public $formData = [];

//    public function __construct()
//    {
//        $this->centralUrl =
//    }

    /**
     * @param array $formData:
     * Expected Key Names are as follows:
     * [postcode] => BL98ES
     * [address] => 65 Sunny Bank Road, Bury
     * %#ExplodeDetails#%65 Sunny Bank Road%#ExplodeDetails#%Bury%#ExplodeDetails#%Lancashire
     * [fullName] => Tester
     * [telephone] => 02545645464
     * [email] => naveed.malik@dynamologic.com
     * [estimatedPropertyValue] => 10000
     * [reasonForSelling] => Equity release
     * [requested_appointment_time] => --optional--
     * [LeadID] => --optional--
     * [reportUrl] => --optional-- // summary report (about the property) url
     *
     * @param bool $testMode
     * @return mixed
     */
    public function sendRequest( $formData = [], $testMode = false ) {
        empty($formData) or $this->formData = $formData;
        if( isset($formData['address']) )
            $this->formData = array_merge( $this->formData, static::addressInfo($formData['address']) );

        $UserData['lead_subject'] = $this->lead_subject;
        $UserData['domain'] = $this->domain;
        $UserData['devicetype'] = $this->devicetype;
        $UserData['source'] = $this->source;
        $UserData['reporturl'] = $this->val("reportUrl");
        $UserData['lead_type'] = $this->lead_type;
        $UserData['IP'] = get_user_ip_address();

        $UserData['name'] = $this->val("fullName");
        $UserData['address'] = $this->val("primary_address_street");
        $UserData['postcode'] = $this->val("postcode");
        $UserData['telephone'] = $this->val("telephone");
        $UserData['estimatedvalue'] = $this->val("estimatedPropertyValue");
        $UserData['email'] = $this->val("email");

        $UserData['SugarList'] = [
            array('name' => 'first_name', 'value' => $UserData['name']),
            array('name' => 'phone_work', 'value' => $UserData['telephone']),
            array('name' => 'primary_address_street', 'value' => $UserData['address']),
            array('name' => 'primary_address_state', 'value' => $this->val("primary_address_state")),
            array('name' => 'primary_address_city', 'value' => $this->val("primary_address_city")),
            array('name' => 'primary_address_postalcode', 'value' => $UserData['postcode']),
            array('name' => 'email1', 'value' => $UserData['email'])
        ];

        // if it is an update request
        if ( $this->leadID ) { $UserData['SugarList'][] = array( 'name' => 'id', 'value' => $this->leadID ); }

        if (isset($formData['requested_appointment_time'])) {
            $UserData['requested_appointment_time'] = $formData['requested_appointment_time'];
        }

        if ($this->insertSugar == 'No') {
            // only send lead email
            $actions_array = json_encode(array(array('name' => 'LeadEmail', 'value' => 'LeadEmail')));
        } else {
            // send lead email:
            $actionsArrayData = array(array('name' => 'LeadEmail', 'value' => 'LeadEmail'));
            // also decide whether to insert or update the lead:
            if ( $this->leadID ) {
                $actionsArrayData[] = array('name' => 'UpdateSugarTest', 'value' => 'UpdateSugarTest');
            } else {
                $actionsArrayData[] = array('name' => 'SugarTest', 'value' => 'SugarTest');
            }
            $actions_array = json_encode($actionsArrayData);
        }

//        pr($formData,"This data was received");
//        pr($this->formData,"This data is retrieved");
//        pr($UserData,"This  is UserData");
//        pr($actions_array,"This  is \$actions_array");
//        exit;

        $api_request = 'method=requiredactions'
            . '&actionsarray=' . $actions_array
            . '&userdata=' . json_encode($UserData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->centralUrl);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        return $response;
    }

    public function val($field)
    {
        return isset($this->formData[$field]) ? $this->formData[$field] : "";
    }

    public static function addressInfo($addressString)
    {
        $result = [];
        $info = explode('%#ExplodeDetails#%', $addressString);
        $result['primary_address_street'] = trim($info[0]);
        $result['primary_address_house'] = trim($info[1]);
        $result['primary_address_city'] = trim($info[2]);
        $result['primary_address_state'] = trim($info[3]);
        return $result;
    }
} 