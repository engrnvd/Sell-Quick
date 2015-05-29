<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/14/2015
 * Time: 10:27 AM
 */
namespace app\components;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

class ValuationFormWidget {
    public $horizontal = false; // Vertical / Horizontal
    public $id = 'valuationForm';
    public $options = ['class' => 'valuationForm'];
    public $model;
    public $modelAttributes;
    public $activeForm;

    public function __construct( $formModel, $config = [] )
    {
        foreach ( $config as $key => $value )
        {
            if( property_exists( get_called_class(), $key ) ) { $this->$key = $value; }
            else{ $this->options[$key] = $value; }
        }
        $this->id .= $this->horizontal ? "Horizontal" : ""; // i.e. valuationFormHorizontal / valuationFormVertical
        $this->model = $formModel;
        $this->modelAttributes = $this->model->attributeLabels();
        $this->activeForm = $this->start();
        $this->show();
    }

    private function show(){

        if( $this->horizontal ) { echo "<div class='row'>"; }
        echo "<div>";
        $extraMarkup = '<img id="loader" class="loader-img" src="'.\Yii::$app->params['assetsDir'].'images/bx_loader.gif" style="display: none; overflow: hidden;">';
        echo $this->input( 'postcode' , ['class' => 'form-control form-field postcode'] , $extraMarkup );
        echo "</div>";
        if( $this->horizontal ) { echo $this->input('fullName'); } else { echo $this->addressInput(); }
        if( $this->horizontal ) { echo "</div>"; }

        if( $this->horizontal ) { echo "<div class='row address-parent-div' style='display: none'>"; }
        if( $this->horizontal ) { echo $this->addressInput(); } else { echo $this->input('fullName'); }
        if( $this->horizontal ) { echo "</div>"; }

        if( $this->horizontal ) { echo "<div class='row'>"; }
        echo $this->input('telephone',['maxlength' => 11,]);
        echo $this->input('email');
        if( $this->horizontal ) { echo "</div>"; }

        if( $this->horizontal ) { echo "<div class='row'>"; }
        echo $this->input('estimatedPropertyValue');
        echo $this->dropDown('reasonForSelling', $this->model->reasonsForSellingOptions());
        if( $this->horizontal ) { echo "</div>"; }

        if( $this->horizontal ) { echo '<div class="text-center col-lg-6 col-sm-12 col-lg-offset-3 margin-top20">'; }
        echo Html::submitButton('Get FREE valuation &amp; cash offer', ['class' => 'btn btn-normal']);
        if( $this->horizontal ) { echo '</div>'; }

        ActiveForm::end();
    }

    private function start(){
        return ActiveForm::begin([
            'id' => $this->id,
            'options' => $this->options,
        ]);
    }

    private function input( $inputName , $config = [] , $extraMarkup = "" ){
        $defConfig = [
            'class' => 'form-control form-field',
            'placeholder' => $this->modelAttributes[$inputName],
        ];
        $config = array_merge( $defConfig, $config );
        $output = "";
        if( $this->horizontal ) { $output .= '<div class="col-lg-6 col-sm-6 margin-top20">'; }
        $output .= $this->activeForm->field( $this->model, $inputName )->label(false)->textInput($config);
        if($extraMarkup) { $output .= $extraMarkup; }
        if( $this->horizontal ) { $output .= '</div>'; }
        return $output;
    }

    private function dropDown( $inputName , $optionsTags , $config = [] )
    {
        $defConfig = [ 'class' => 'form-control option-field1', ];
        $config = array_merge( $defConfig, $config );
        $output = "";
        if( $this->horizontal ) { $output .= '<div class="col-lg-6 col-sm-6 margin-top20">'; }
        $output .= $this->activeForm->field( $this->model, $inputName )
            ->label(false)
            ->dropDownList( $optionsTags, $config);
        if( $this->horizontal ) { $output .= '</div>'; }
        return $output;
    }

    private function addressInput() { return $this->dropDown('address' , [] , [ 'style' => "display:none;", 'class' => 'form-control option-field1 address', ]); }
}
