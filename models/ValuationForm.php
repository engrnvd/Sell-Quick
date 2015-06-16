<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/12/2015
 * Time: 2:46 PM
 */
namespace app\models;
use yii\base\Model;

class ValuationForm extends Model
{
    public $postcode;
    public $address;
    public $fullName;
    public $telephone;
    public $email;
    public $estimatedPropertyValue;
    public $reasonForSelling;
    public static $sqPriorityList = [
        'Selling to move into rented accommodation',
        'Financial difficulty',
        'Facing repossession',
        'Divorce / separation',
        'Emigration / relocation',
    ];
    private $reasonsForSellingOptions = [
        'Selling to buy another property',
        'Selling to move into rented accommodation',
        'Financial difficulty',
        'Facing repossession',
        'Divorce / separation',
        'Inherited property',
        'Selling investment',
        'Emigration / relocation',
        'Equity release',
    ];

    public function rules()
    {
        return [
            [['postcode', 'address', 'fullName', 'telephone','email', 'estimatedPropertyValue', 'reasonForSelling'], 'required'],
            ['email', 'email'],
            ['estimatedPropertyValue', 'string', 'max' => 12,],
            ['reasonForSelling', 'in', 'range' => $this->reasonsForSellingOptions, 'message' => 'Please choose a reason for selling', ],
            ['telephone', 'string', 'max' => 11, 'min' => 11, 'message' => 'Phone must contain 11 digits only', ],
            ['telephone', 'custom\validators\UkPhoneValidator', ],
            ['postcode', 'match', 'pattern' => '/[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i', 'message' => 'Please enter a valid Postcode'],
            /*
             * estimatedPropertyValue allowed formats
             * 100,000
             * £100,000
             * 100000
             * £100000
             * */
            ['estimatedPropertyValue', 'match', 'pattern' => '/^\£?(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+)?$/'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'postcode' => 'Postcode',
            'address' => 'Address',
            'fullName' => 'Full Name',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'estimatedPropertyValue' => 'Estimated Property Value',
            'reasonForSelling' => 'Reason For Selling',
        ];
    }

    public function textInputs()
    {
        return ['postcode', 'fullName', 'telephone', 'email', 'estimatedPropertyValue'];
    }

    public function reasonsForSellingOptions()
    {
        $output = ['' => 'Please select a reason for selling'];
        foreach ( $this->reasonsForSellingOptions as $option ){ $output[$option] = $option; }
        return $output;
    }
}