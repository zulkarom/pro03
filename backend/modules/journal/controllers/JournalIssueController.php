<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\JournalIssue;
use backend\modules\journal\models\JournalIssueSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use backend\modules\journal\models\Article;
use common\models\Model;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalIssueController extends Controller
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
        $searchModel = new JournalIssueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Journal model.
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
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JournalIssue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Journal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			//if status current issue or archived
			if(in_array($model->status,[10,20,30])){
				//check publish number
				$articles = $model->articles;
				if($articles){
					foreach($articles as $ar){
						if(!$ar->publish_number){
							Yii::$app->session->addFlash('error', "No article number!");
							return $this->redirect(['update', 'id' => $model->id]);
						}
					}
					
				}else{
					Yii::$app->session->addFlash('error', "No article!");
					return $this->redirect(['update', 'id' => $model->id]);
				}
				
			}
            if($model->save()){
				Yii::$app->session->addFlash('success', "Journal Updated");
			}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionArticle($id)
    {
        $model = $this->findModel($id);
		
        $articles = $model->articles;
	
		if($articles){
			foreach($articles as $article){
				$article->scenario = 'publish_number';
			}
		}
		
        
        
        if ($model->load(Yii::$app->request->post())) {

            Model::loadMultiple($articles, Yii::$app->request->post());
      
			$unik = ArrayHelper::map($articles, 'id', 'publish_number');
			
			
	
			if(count(array_unique($unik)) < count($unik)){
				Yii::$app->session->addFlash('error', "Article numbers must be unique in one journal!");
				return $this->redirect(['article', 'id' => $model->id]);
			}
		
            
            $valid = Model::validateMultiple($articles);
            
            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                        foreach ($articles as $indexAu => $article) {
						
                            if (!($flag = $article->save(false))) {
											
                                break;
                            }
                        }

                    if ($flag) {
                        $transaction->commit();
                            Yii::$app->session->addFlash('success', "Update Successful");
							return $this->redirect(['journal-issue/article', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    
                }
            }
		}

        
        
        return $this->render('article', [
            'model' => $model,
            'articles' => (empty($articles)) ? [new Article] : $articles
        ]);

    }


    /**
     * Deletes an existing Journal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = JournalIssue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
