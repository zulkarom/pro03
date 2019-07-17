<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\Article;
use backend\modules\journal\models\SubmissionSearch;
use backend\modules\journal\models\UserScope;
use common\models\Upload;
use yii\db\Expression;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use raoul2000\workflow\validation\WorkflowScenario;
use common\models\Model;
use common\models\UserToken;
use yii\filters\AccessControl;
use backend\modules\journal\models\Setting;
use common\models\User;
use yii\web\NotFoundHttpException;
use backend\modules\account\models\Invoice;

class SubmissionController extends \yii\web\Controller
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

        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPreEvaluate($id)
    {
	$model = $this->findModel($id);
	
	/* if($id == $model->manuscript_no){
		return $this->redirect(['manuscript-no', 'id' => $model->id]);
	} */
	
	$reject_model = $this->findModel($id);
	
	$status = $model->wfStatus;
	$model->scenario = WorkflowScenario::enterStatus('bm-payment-pending');
	$reject_model->scenario = WorkflowScenario::enterStatus('ra-reject');
		
		if ($model->load(Yii::$app->request->post())) {
			$wfaction = Yii::$app->request->post('wfaction');
			if($wfaction == 'accept-manuscript'){
				return $this->acceptManuscript($model);
			}else if($wfaction == 'reject'){
				return $this->reject($reject_model);
			}
		}
		return $this->render('pre_evaluate', [
            'model' => $model,
			'reject_model' => $reject_model
        ]);
	}
	
	protected function acceptManuscript($model){
		/* ASSIGN ASSOCIATE */
		$model->pre_evaluate_at = new Expression('NOW()');
		$model->pre_evaluate_by = Yii::$app->user->identity->id;
		$model->sendToStatus('bm-payment-pending');
		$model->invoice_id = Invoice::createInvoice($model);
		
		if($model->save()){
			$model->sendEmail();
			Yii::$app->session->addFlash('success', "Manuscript has been accepted.");
			return $this->redirect(['payment/index']);
			
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
			return $this->redirect(['/journal/payment/index', 'id' => $model->id]);

		}
		
		return $this->redirect(['/journal/submission/pre-evaluate', 'id' => $model->id]);
	}
	
	public function actionManuscriptInfo($id){
		$this->layout= 'ajax';
		$model = $this->findModel($id);
		return $this->render('manuscript_info', [
				'model' => $model,
		]);
		
	}
	
	public function actionManuscriptNo($id){
		$model = $this->findModel($id);
		$model->scenario = 'manuscript';
		
		
	if ($model->load(Yii::$app->request->post())) {
		
		//Yii::$app->session->addFlash('error', $model->id . '=' . $model->manuscript_no);
		
		if($id == $model->manuscript_no){
			Yii::$app->session->addFlash('error', "Manuscript no. cannot be equal to article id: " . $model->id);
		}
		
		if($model->save()){
			return $this->redirect(['pre-evaluate', 'id' => $model->id]);
		}else{
			
			$model->flashError();
		}
	}

		
		return $this->render('manuscript_no', [
            'model' => $model
        ]);
		
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionDownload($attr, $id, $identity = true){
		$attr = $this->clean($attr);
        $model = $this->findModel($id);
		$filename = strtoupper($attr);
		Upload::download($model, $attr, $filename);
	}
	
	public function actionUpload($attr, $id){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $model->file_controller = 'submission';

        return Upload::upload($model, $attr, 'updated_at');

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
