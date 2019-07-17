<?php

namespace ijeob\controllers;

use Yii;
use backend\modules\account\models\Invoice;
use backend\modules\account\models\InvoiceItem;
use ijeob\models\InvoiceSearch;
use backend\modules\account\models\InvoicePdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Model;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    

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


    /**
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPdf($id){
		$model = $this->findModel($id);
		$pdf = new InvoicePdf;
		$pdf->model = $model;
		$pdf->generatePdf();
	}

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
