<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\JournalScope;
use backend\modules\journal\models\JournalScopeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Expression;

/**
 * JournalScopeController implements the CRUD actions for JournalScope model.
 */
class JournalScopeController extends Controller
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
     * Lists all JournalScope models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new JournalScopeSearch();
		$searchModel->current_journal = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		
		$model = new JournalScope();

        if ($model->load(Yii::$app->request->post())) {
			$model->created_at = new Expression('NOW()');
			$model->journal_id = $id;
			if($model->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
				 return $this->redirect(['index', 'id' => $id]);
			}
           
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
        ]);
    }

    /**
     * Displays a single JournalScope model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
       
    }

    /**
     * Creates a new JournalScope model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new JournalScope();

        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
			}
            return $this->redirect(['index', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JournalScope model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $scope)
    {
        $model = $this->findModel($scope);

        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
			}
            return $this->redirect(['index', 'id' => $id, 'scope' => $model->id]);
        }
		
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JournalScope model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $scope)
    {
        $this->findModel($scope)->delete();

        return $this->redirect(['index', 'id' => $id]);
    }

    /**
     * Finds the JournalScope model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JournalScope the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JournalScope::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
