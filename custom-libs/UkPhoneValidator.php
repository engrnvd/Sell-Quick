<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/13/2015
 * Time: 2:08 PM
 */
namespace custom\validators;

use yii\validators\Validator;

class UkPhoneValidator extends Validator
{
    private $regexArray = [
        '^01[\d+]*|^02[0-9]*|^07[0-9]*',
        '^\d{11}$',
    ];

    public function init()
    {
        parent::init();
        $this->message = 'The Phone Number you entered is not valid.';
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        $isValid = true;
        foreach ( $this->regexArray as $regex ){
            if( !preg_match( "/".$regex."/", $value) ) { $isValid = false; }
        }
        if ( !$isValid ) {
            $model->addError($attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        $regexArray = json_encode( $this->regexArray );
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return
<<<JS
        var isValid = true;
        var regexArray = $regexArray;
        console.log(regexArray);
        for( var key in regexArray ){
            var regex = new RegExp(regexArray[key]);
            if( !regex.test(value) ){
                isValid = false;
                console.log("Following Regex Failed against "+value+":");
                console.log(regexArray[key]);
                break;
            }
        }
        if( !isValid ) { messages.push($message) }
JS;
    }
}