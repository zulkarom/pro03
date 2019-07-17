<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\JournalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\filters\AccessControl;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalUpdateController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionEditorialBoard($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('board', [
            'model' => $model,
        ]);
    }
	
	public function actionSubmission($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('submission', [
            'model' => $model,
        ]);
    }
	
	public function actionEthics($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
			Yii::$app->session->addFlash('success', "Data Updated");
        }

        return $this->render('ethics', [
            'model' => $model,
        ]);
    }

   

    /**
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
