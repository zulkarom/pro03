<?php

namespace ijeob\controllers;

use Yii;
use backend\modules\account\models\Transaction;
use ijeob\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\account\models\Invoice;
use backend\modules\account\models\InvoicePdf;
use backend\modules\account\models\Receipt;
use backend\modules\account\models\ReceiptPdf;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionInvoice($id){
		$model = $this->findInvoice($id);
		//check access
		if($model->client_id != Yii::$app->user->identity->id){
			throw new NotFoundHttpException('No Access to invoice');
		}
		
		$pdf = new InvoicePdf;
		$pdf->model = $model;
		$pdf->generatePdf();
	}
	
	protected function findInvoice($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist..');
    }
	
	public function actionReceipt($id){
		$model = $this->findReceipt($id);
		//check access
		if($model->client_id != Yii::$app->user->identity->id){
			throw new NotFoundHttpException('No Access to invoice');
		}
		
		$pdf = new ReceiptPdf;
		$pdf->model = $model;
		$pdf->generatePdf();
	}
	
	protected function findReceipt($id)
    {
        if (($model = Receipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist..');
    }
}
