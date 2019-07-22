<?php
namespace ijeob\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use ijeob\models\ArchiveSearch;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\Article;


/**
 * Page controller
 */
class PageController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        
    }
	
	/**
     * Committees.
     *
     * @return mixed
     */
    public function actionCommittee()
    {
		$journal_id = Yii::$app->params['journal_id'];
		$journal = Journal::findOne($journal_id);
		return $this->render('committe', [
			'journal' => $journal
		]);
        
    }
	
	public function actionSubmissionGuideline(){
		$journal_id = Yii::$app->params['journal_id'];
		$journal = Journal::findOne($journal_id);
		return $this->render('submission-guideline', [
			'journal' => $journal
		]);
	}
	
	public function actionEditorialPolicy(){
		return $this->render('editorial-policy');
	}
	public function actionScope(){
		$journal_id = Yii::$app->params['journal_id'];
		$journal = Journal::findOne($journal_id);
		return $this->render('scope', [
			'journal' => $journal
		]);
	}
	
	public function actionEthicalGuideline(){
		$journal_id = Yii::$app->params['journal_id'];
		$journal = Journal::findOne($journal_id);
		return $this->render('ethical-guideline', [
			'journal' => $journal
		]);
	}
	
	public function actionJournal($id){
		$journal = $this->findJournal($id);
		return $this->render('journal',[
			'journal' => $journal
		]);
	}
	
	  /**
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findJournal($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionArchive(){
		$searchModel = new ArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('archive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	
	public function actionArticle($id){
		$model = $this->findArticle($id);
		return $this->render('article', [
            'model' => $model,
        ]);
	}
	
	public function actionBibtext($id){
		if (($model = Article::findOne($id)) == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
		
		return Citation::bibText($id);
	}
	
	public function actionArticleFullpaper($id){
		
	}
	
	/**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findArticle($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
}
