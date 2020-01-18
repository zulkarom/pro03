<?php
namespace ijeob\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use ijeob\models\ArchiveSearch;
use ijeob\models\Citation;
use common\models\User;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\JournalIssue;
use backend\modules\journal\models\Article;
use common\models\Upload;


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
	
	public function actionJournalIssue($id){
		$issue = $this->findJournalIssue($id);
		return $this->render('journal',[
			'issue' => $issue
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
	
	 protected function findJournalIssue($id)
    {
        if (($model = JournalIssue::findOne($id)) !== null) {
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
	
	public function actionArticleVolume($volume, $issue, $publish_number){
		$model = $this->searchArticle($volume, $issue, $publish_number);
		return $this->render('article', [
            'model' => $model,
        ]);
	}
	
	protected function searchArticle($volume, $issue, $publish_number)
    {
        if (($model = Article::find()
        ->innerJoin('jeb_journal_issue', 'jeb_journal_issue.id = jeb_article.journal_issue_id')
         ->where(['jeb_journal_issue.volume' => $volume, 'jeb_journal_issue.issue' => $issue, 'jeb_article.publish_number' => $publish_number])
        ->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionTemplateBm(){
		$journal_id = Yii::$app->params['journal_id'];
		$journal = $this->findJournal($journal_id);
		Upload::download($journal, 'template2', 'template-bm');
	}
	
	public function actionTemplateEn(){
		$journal_id = Yii::$app->params['journal_id'];
		$journal = $this->findJournal($journal_id);
		Upload::download($journal, 'template', 'template-en');
	}
	
	public function actionRegister(){
		$user = new User;
		$user->scenario = 'checkemail';
		
		if ($user->load(Yii::$app->request->post())) {
			if($user->isEmailExist()){
				Yii::$app->session->addFlash('error', "You have already registered, please proceed to login page. You can use forgot password feature in case you have forgotten your password");
			}else{
				$this->redirect(['user/register', 'email' => $user->email]);
			}
		}

		return $this->render('register',[
			'user' => $user
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
