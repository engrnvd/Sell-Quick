<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/29/2015
 * Time: 3:57 PM
 */
namespace yii\nvd;

/**
 * Class SugarRequestHandler
 * @package yii\nvd
 * @depends:
 *  - yii\nvd\Mailer: should be available for debugMode email
 *  - Yii::$app->params['baseUrl']: should be declared for debugMode email
 */
class SugarRequestHandler {
    public $centralUrl = "http://6gvt-nynn.accessdomain.com/spcentralengine/request.action.php";
    public $lead_subject = "Sell Quick - LP 1"; // email subject
    public $domain = "sq"; // e.g. eea, sq
    public $devicetype = "desktop";
    public $source = "lpt"; // e.g. lpt
    public $lead_type; // SQ or SQ Priority Lead
    public $leadID = null;
    public $insertSugar = "Yes";
    public $formData = [];

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
     * @param bool $debugMode:
     * When set to true,
     *  - will send a detailed email to $debugModeReportEmail
     *  - will not send request to the server
     * @param string $debugModeReportEmail
     * @return mixed
     */
    public function sendRequest( $formData = [], $debugMode = false, $debugModeReportEmail = "naveed.malik@dynamologic.com" ) {
        empty($formData) or $this->formData = $formData;
        isset($formData['address']) and $this->formData = array_merge( $this->formData, static::addressInfo($formData['address']) );

        $userData['lead_subject'] = $this->lead_subject;
        $userData['domain'] = $this->domain;
        $userData['devicetype'] = $this->devicetype;
        $userData['source'] = $this->source;
        $userData['reporturl'] = $this->val("reportUrl");
        $userData['lead_type'] = $this->lead_type;
        $userData['IP'] = get_user_ip_address();

        $userData['name'] = $this->val("fullName");
        $userData['address'] = $this->val("primary_address_street");
        $userData['postcode'] = $this->val("postcode");
        $userData['telephone'] = $this->val("telephone");
        $userData['estimatedvalue'] = $this->val("estimatedPropertyValue");
        $userData['email'] = $this->val("email");

        $userData['SugarList'] = [
            [ 'name' => 'first_name', 'value' => $userData['name'] ],
            [ 'name' => 'phone_work', 'value' => $userData['telephone'] ],
            [ 'name' => 'primary_address_street', 'value' => $userData['address'] ],
            [ 'name' => 'primary_address_state', 'value' => $this->val("primary_address_state") ],
            [ 'name' => 'primary_address_city', 'value' => $this->val("primary_address_city") ],
            [ 'name' => 'primary_address_postalcode', 'value' => $userData['postcode'] ],
            [ 'name' => 'email1', 'value' => $userData['email'] ]
        ];

        // if it is an update request
        if ( $this->leadID )
            $userData['SugarList'][] = [  'name' => 'id', 'value' => $this->leadID  ];

        if (isset($formData['requested_appointment_time']))
            $userData['requested_appointment_time'] = $formData['requested_appointment_time'];

        // register send-lead-email action:
        $actionsArrayData = [ [ 'name' => 'LeadEmail', 'value' => 'LeadEmail'] ];

        if ($this->insertSugar == 'Yes')
        {
            // register insert-lead action:
            if( $this->leadID ) // it is an update request
                $actionsArrayData[] = [ 'name' => 'UpdateSugarTest', 'value' => 'UpdateSugarTest' ];
            else // it is an insert request
                $actionsArrayData[] = [ 'name' => 'SugarTest', 'value' => 'SugarTest' ];
        }

        $actions_array = json_encode($actionsArrayData);

        if($debugMode)
        {
            $body = "<h2><pre>";
            $body .= "This data was received:<br>";
            $body .= var_export($formData,true);
            $body .= "<br><br>\$this->formData:<br>";
            $body .= var_export($this->formData,true);
            $body .= "<br><br>\$UserData:<br>";
            $body .= var_export($userData,true);
            $body .= "<br><br>\$actions_array:<br>";
            $body .= var_export($actions_array,true);
            $body .= "</pre></h2>";
            Mailer::send($debugModeReportEmail,"Test Mode Active for SQ-LP",$body,\Yii::$app->params['baseUrl']);
            return false;
        }

        $api_request = "method=requiredactions";
        $api_request .= "&actionsarray=".$actions_array;
        $api_request .= "&userdata=".json_encode($userData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->centralUrl);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        return curl_exec($ch);
    }

    private function val($field)
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