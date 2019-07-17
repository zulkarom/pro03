<?php

namespace backend\modules\journal\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\journal\models\Archive;
use backend\modules\journal\models\Article;
use backend\modules\journal\models\ArticleAuthor;
use backend\modules\journal\models\Journal;
use yii\db\Expression;

/**
 * Default controller for the `journal` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		
        return $this->render('index');
    }
	
	public function actionRestore()
    {
		$list = Archive::find()->all();
		
		foreach($list as $archive){
			$model = new Article;
			//$model->scenario = WorkflowScenario::enterStatus('aa-draft');
			
			$model->title = $archive->title;
			$model->abstract = $archive->abstract;
			$model->keyword = $archive->keyword;
			$model->scope_id = 1;
			$model->reference = 'to be added';
			$model->user_id = 1;
			
			$model->camera_ready_at = new Expression('NOW()');
			$model->cameraready_file = '2018/jeb_archive/' . $archive->pdf_file;
			
			$journal = Journal::find()->where(['volume' => $archive->volume, 'issue' => $archive->issue])->one();
			
			$model->journal_id = $journal->id;

			$model->sendToStatus('aa-draft');
			
			if($model->save()){
				
				$arr = explode(',',trim($archive->author));
				if($arr){
					foreach($arr as $au){
						$author = new ArticleAuthor;
						$name = explode(';', trim($au));
						$author->article_id = $model->id;
						$author->firstname = trim($name[0]);
						$author->email = 'plz_update@email.em';
						$kira = count($name);
						if($kira > 1){
							$author->lastname = trim($name[1]);
						}
						
						$author->save();
					}
				}
				
			}

		}
		
        return $this->render('index');
    }

}
