<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\Article;
use backend\modules\account\models\Invoice;
use backend\modules\account\models\InvoicePdf;
use backend\modules\journal\models\PaymentSearch;
use backend\modules\journal\models\UserScope;
use common\models\Upload;
use yii\db\Expression;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use raoul2000\workflow\validation\WorkflowScenario;
use common\models\Model;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\NotFoundHttpException;

class PaymentController extends \yii\web\Controller
{
	

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionVerify($id)
    {
		
	$model = $this->findModel($id);
	
	$reject_model = $this->findModel($id);
	
	$status = $model->wfStatus;
	$model->scenario = WorkflowScenario::enterStatus('bt-assign-associate');
	$reject_model->scenario = WorkflowScenario::enterStatus('bm-payment-pending');
		
		if ($model->load(Yii::$app->request->post())) {
			
			$wfaction = Yii::$app->request->post('wfaction');
			if($wfaction == 'verify'){
				return $this->verifyPayment($model);
			}else if($wfaction == 'reject'){
				return $this->rejectPayment($reject_model);
			}
		}
		return $this->render('verify', [
            'model' => $model,
			'reject_model' => $reject_model
        ]);
	}
	
	public function actionInvoice($id){
		
		$model = $this->findInvoice($id);
		$pdf = new InvoicePdf;
		$pdf->model = $model;
		$pdf->generatePdf();
		
	}
			
	
	protected function verifyPayment($model){
		
		/* ASSIGN ASSOCIATE */
		$invoice = $model->invoice;
		$invoice->status = 10;
		$invoice->save();
		$model->sendToStatus('bt-assign-associate');
		/////////////
		
		if($model->save()){
			$model->sendEmail();
			Yii::$app->session->addFlash('success', "The payment has been successfully verified.");
			return $this->redirect(['/journal/review/assign-associate', 'id' => $model->id]);
		}else{
			$model->flashError();
			return $this->redirect(['/journal/payment/verify', 'id' => $model->id]);

		}
	}
	
	protected function rejectPayment($model){
		$model->sendToStatus('bm-payment-pending');
		/////////////
		
		if($model->save()){
			//$model->sendEmail();
			Yii::$app->session->addFlash('success', "The payment has been reverted to pending.");
			return $this->redirect('index');
		}else{
			if($model->getErrors()){
				foreach($model->getErrors() as $error){
					if($error){
						foreach($error as $e){
							Yii::$app->session->addFlash('error', $e);
						}
					}
				}
			}
			return $this->redirect(['/journal/payment/verify', 'id' => $model->id]);

		}
	}
	
	
	
	/**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist..');
    }
	
	protected function findInvoice($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist..');
    }
	
	public function actionDownload($attr, $id, $identity = true){
		$attr = $this->clean($attr);
        $model = $this->findModel($id);
		$filename = strtoupper($attr);
		Upload::download($model, $attr, $filename);
	}

	
	protected function clean($string){
        $allowed = ['submission', 'payment'];
        
        foreach($allowed as $a){
            if($string == $a){
                return $a;
            }
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');

    }


}
