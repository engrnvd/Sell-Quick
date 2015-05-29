<?php

namespace app\controllers;

use app\models\ValuationForm;
use Yii;
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

            // decide where to go, depending on an sq-priority lead or a standard sq-lead
            if( $sqPriorityLead )
            {
                return Yii::$app->response->redirect("thank-you");
            }
            else
            {
                // save form data to session and redirect
                // should be removed from session at the destination
                Yii::$app->session->set( "formData", Yii::$app->request->post() );
                return Yii::$app->response->redirect("offer-estimation");
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
            $viewData['formData'] = $formData['ValuationForm'];
            return $this->render( 'offer-estimation-view' , $viewData );
        }
        // no data is saved to session (i.e. no form submitted)
        return Yii::$app->response->redirect(Yii::$app->params['baseUrl']);
    }

    public function actionMoreAboutQuickSale()
    {
        return $this->render( 'more-about-quick-sale' );
    }

    public function actionThankYou()
    {
        return $this->render( 'thanks-view' );
    }

    public function action404()
    {
        return $this->render('404');
    }

}
