<?php

namespace backend\modules\account\controllers;

use Yii;
use backend\modules\account\models\Invoice;
use backend\modules\account\models\InvoiceItem;
use backend\modules\account\models\InvoiceSearch;
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

    /**
     * Displays a single Invoice model.
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
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$items = $model->invoiceItems;
		if($items){
			foreach($items as $item){
				$item->scenario= 'paper_item';
			}
			
		}

        if ($model->load(Yii::$app->request->post())) {
				$this->processItems($model, $items);
        }

        return $this->render('update', [
            'model' => $model,
			'items' => (empty($items)) ? [new InvoiceItem] : $items
        ]);
    }
	
	private function processItems($model, $items){
		
			
			$oldIDs = ArrayHelper::map($items, 'id', 'id');
            $items = Model::createMultiple(InvoiceItem::classname(), $items);
            Model::loadMultiple($items, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($items, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($items) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            InvoiceItem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($items as $item) {
                            $item->invoice_id = $model->id;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
	}


    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		InvoiceItem::deleteAll(['invoice_id' => $id]);
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
