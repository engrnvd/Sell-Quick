<?php

namespace app\controllers;

use app\models\ValuationForm;
use Yii;
use yii\nvd\SugarRequestHandler;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $formModel = new ValuationForm();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) // valid data received in $formModel
        {
            // variables
            $sqPriorityLead = in_array( $formModel->reasonForSelling, ValuationForm::$sqPriorityList );
            // sugar lead insertion
            $sugarHandler = new SugarRequestHandler();
            $sugarHandler->lead_type = $sqPriorityLead ? "SQ Priority" : "SQ";
            $sugarHandler->sendRequest( Yii::$app->session->get("formData") );

            // decide where to go, depending on an sq-priority lead or a standard sq-lead
            if( $sqPriorityLead )
            {
                return Yii::$app->response->redirect(Yii::$app->params['baseUrl']."thank-you");
            }
            else
            {
                // save form data to session and redirect
                // should be removed from session at the destination
                Yii::$app->session->set( "formData", $formModel->toArray() );
                return Yii::$app->response->redirect(Yii::$app->params['baseUrl']."offer-estimation");
            }
        }
        else // either the page is initially displayed or there is some validation error
        {
            return $this->render('index-view', ['formModel' => $formModel]);
        }
    }

    public function actionOfferEstimation()
    {
        // we should be here only if data is saved by index page to session
        if( $formData = Yii::$app->session->get("formData") )
        {
            $viewData['formData'] = $formData;

            $viewData['estimatedPropertyValue'] = static::getEstimatedValue( $formData['estimatedPropertyValue'] );

            return $this->render( 'offer-estimation-view' , $viewData );
        }
        // no data is saved to session (i.e. no form submitted)
        return Yii::$app->response->redirect(Yii::$app->params['baseUrl']);
    }

    public function actionMoreAboutQuickSale()
    {
        return $this->renderPartial( 'more-about-quick-sale', ["formData" => Yii::$app->session->get("formData")] );
    }

    public function actionThankYou()
    {
        return $this->render( 'thanks-view' );
    }

    public function action404()
    {
        return $this->render('404');
    }

    /**
     * @param $value
     * @return string
     * removes , and/or £ from $value. if any
     */
    private static function getEstimatedValue($value){
        return preg_replace("/[^\d]/", "", $value );
    }

}
