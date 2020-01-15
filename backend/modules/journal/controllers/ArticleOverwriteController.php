<?php

namespace backend\modules\journal\controllers;

use Yii;
use backend\modules\journal\models\Article;
use backend\modules\journal\models\ArticleOverwrite;
use backend\modules\journal\models\ArticleAuthor;
use backend\modules\journal\models\ArticleOverwriteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\UploadFile;
use yii\helpers\Json;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\Model;

/**
 * ArticleOverwriteController implements the CRUD actions for ArticleOverwrite model.
 */
class ArticleOverwriteController extends Controller
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
     * Lists all ArticleOverwrite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleOverwriteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleOverwrite model.
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
     * Creates a new ArticleOverwrite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleOverwrite();
		$ori = new Article;
		$model->manuscript_no = Yii::$app->user->identity->id . '-' . time();
		$model->yearly_number = $ori->genYearlyNumber();
		
		$authors = [new ArticleAuthor];

        if ($model->load(Yii::$app->request->post())) {
            
            $authors = Model::createMultiple(ArticleAuthor::classname());
			
            Model::loadMultiple($authors, Yii::$app->request->post());
		
            
            $valid = $model->validate();
            
            $valid = Model::validateMultiple($authors) && $valid;
            
            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        
                        foreach ($authors as $indexAu => $author) {
                            
                            if ($flag === false) {
                                break;
                            }

                            $author->article_id = $model->id;

                            if (!($flag = $author->save(false))) {
                                break;
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();
						Yii::$app->session->addFlash('success', "Data Updated");
						return $this->redirect(['update', 'id' => $model->id]);
						
						
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
			'authors' => (empty($authors)) ? [new ArticleAuthor] : $authors
        ]);
    }

    /**
     * Updates an existing ArticleOverwrite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$authors = $model->articleAuthors;

        if ($model->load(Yii::$app->request->post())) {
			
			$oldAuthorIDs = ArrayHelper::map($authors, 'id', 'id');
            
            $authors = Model::createMultiple(ArticleAuthor::classname());
			
            Model::loadMultiple($authors, Yii::$app->request->post());
			
			$deletedAuthorIDs = array_diff($oldAuthorIDs, array_filter(ArrayHelper::map($authors, 'id', 'id')));
            
            $valid = $model->validate();
            
            $valid = Model::validateMultiple($authors) && $valid;
            
            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
						
						if (! empty($deletedAuthorIDs)) {
                            ArticleAuthor::deleteAll(['id' => $deletedAuthorIDs]);
                        }
                        
                        foreach ($authors as $indexAu => $author) {
                            
                            if ($flag === false) {
                                break;
                            }

                            $author->article_id = $model->id;

                            if (!($flag = $author->save(false))) {
                                break;
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();
						Yii::$app->session->addFlash('success', "Data Updated");
						return $this->redirect(['update', 'id' => $model->id]);
						
						
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    
                }
            }
			
			
			
        }

        return $this->render('update', [
            'model' => $model,
			'authors' => (empty($authors)) ? [new ArticleAuthor] : $authors
        ]);
    }

    /**
     * Deletes an existing ArticleOverwrite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteArticle($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDeleteFile($attr, $id)
    {
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $attr_db = $attr . '_file';
        
        $file = Yii::getAlias('@upload/' . $model->{$attr_db});
        
        $model->scenario = $attr . '_delete';
        $model->{$attr_db} = '';
        $model->updated_at = new Expression('NOW()');
        if($model->save()){
            if (is_file($file)) {
                unlink($file);
                
            }
            
            return Json::encode([
                        'good' => 1,
                    ]);
        }else{
            return Json::encode([
                        'errors' => $model->getErrors(),
                    ]);
        }
        


    }


    /**
     * Finds the ArticleOverwrite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleOverwrite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleOverwrite::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionDownloadFile($attr, $id, $identity = true){
		$attr = $this->clean($attr);
        $model = $this->findModel($id);
		$filename = strtoupper($attr);
		UploadFile::download($model, $attr, $filename);
	}
	
	public function actionUploadFile($attr, $id){
        $attr = $this->clean($attr);
        $model = $this->findModel($id);
        $model->file_controller = 'article-overwrite';

        return UploadFile::upload($model, $attr, 'updated_at');

    }
	
	protected function clean($string){
        $allowed = ['submission', 'review', 'reviewed', 'correction', 'cameraready'];
        
        foreach($allowed as $a){
            if($string == $a){
                return $a;
            }
        }
        
        throw new NotFoundHttpException('Not available attribute to download');

    }
}
