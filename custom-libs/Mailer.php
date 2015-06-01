<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/11/2015
 * Time: 11:21 AM
 */

namespace yii\nvd;
use yii\base\Exception;

require_once __DIR__."/mandrill/Mandrill.php";

class Mailer extends \Mandrill{
    public $apiKey;

    public function __construct(){
        $this->apiKey = \Yii::$app->params['mail']['apiKey'];
        parent::__construct($this->apiKey);
    }

    public static function send( $to, $subject, $body, $from_name, $from_email=''){
        $mailer = new Mailer();
        if(!$from_email){ $from_email = \Yii::$app->params['mail']['fromEmail']; }
        $message = array(
            'subject' => $subject,
            'html' => $body,
            'from_email' => $from_email,
            'from_name' => $from_name,
            'to' => array(
                array(
                    'email' => $to,
                    'name' => $to,
                    'type' => 'to'
                )
            ),
        );
        try{
            $mailer->messages->send($message);
        }catch (Exception $e){

        }
    }
}