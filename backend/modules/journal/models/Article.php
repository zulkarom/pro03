<?php

namespace backend\modules\journal\models;

use Yii;
use raoul2000\workflow\validation\WorkflowValidator;
use raoul2000\workflow\validation\WorkflowScenario;
use common\models\User;
use common\models\AuthAssignment;
use backend\modules\account\models\Invoice;
use backend\modules\account\models\Receipt;

/**
 * This is the model class for table "jeb_article".
 *
 * @property int $id
 * @property int $journal_id
 * @property string $manuscript_no
 * @property int $yearly_number
 * @property int $user_id
 * @property string $title
 * @property string $keyword
 * @property string $abstract
 * @property string $reference
 * @property int $scope_id
 * @property string $status
 * @property string $submission_file
 * @property string $updated_at
 * @property string $draft_at
 * @property string $submit_at
 * @property string $pre_evaluate_at
 * @property int $pre_evaluate_by
 * @property int $invoice_id
 * @property string $payment_file
 * @property string $payment_note
 * @property int $associate_editor
 * @property string $review_file
 * @property string $pre_evaluate_note
 * @property string $asgn_reviewer_at
 * @property string $asgn_associate_at
 * @property int $asgn_reviewer_by
 * @property string $review_at
 * @property string $review_submit_at
 * @property int $response_by
 * @property string $response_at
 * @property string $response_note
 * @property int $response_option
 * @property string $correction_at
 * @property string $correction_note
 * @property string $correction_file
 * @property int $post_evaluate_by
 * @property string $post_evaluate_at
 * @property int $assistant_editor
 * @property string $camera_ready_at
 * @property int $camera_ready_by
 * @property string $camera_ready_note
 * @property string $cameraready_file
 * @property string $assign_journal_at
 * @property string $journal_at
 * @property int $journal_by
 * @property int $journal_issue_id
 * @property string $reject_at
 * @property int $reject_by
 * @property string $reject_note
 * @property string $publish_number
 * @property string $doi_ref
 * @property int $withdraw_by
 * @property string $withdraw_at_status
 * @property string $withdraw_at
 * @property string $withdraw_note
 * @property string $withdraw_request_at
 */
class Article extends \yii\db\ActiveRecord
{
	
	public $submission_instance;
	public $review_instance;
	public $correction_instance;
	public $galley_instance;
	public $finalise_instance;
	public $proofread_instance;
	public $cameraready_instance;
	public $postfinalise_instance;
	public $payment_instance;
	public $email_workflow;
	
	public $file_controller;
	
	public $scope_name;
	public $max_yearly;
	
	public $pay_amount = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['status'], WorkflowValidator::className()],
			
            [['title', 'journal_id', 'keyword', 'abstract', 'user_id'], 'required', 'on' => WorkflowScenario::enterStatus('aa-draft')],
			
			[['manuscript_no'], 'required', 'on' => 'manuscript'],
			
			['manuscript_no', 'unique', 'targetClass' => '\backend\modules\journal\models\Article', 'message' => 'This manuscript no. has already been taken'],
			
			[['submit_at', 'submission_file','yearly_number'], 'required', 'on' => WorkflowScenario::enterStatus('ba-pre-evaluate')],
			
			[['pre_evaluate_at', 'pre_evaluate_by', 'invoice_id', 'pay_amount'], 'required', 'on' => WorkflowScenario::enterStatus('bm-payment-pending')],
			
			[['payment_note'], 'required', 'on' => WorkflowScenario::enterStatus('bo-payment-submit')],
			
			[['payment_verified_at', 'receipt_id'], 'required', 'on' => WorkflowScenario::enterStatus('bt-assign-associate')],
			
			[['associate_editor', 'review_file', 'asgn_associate_at'], 'required', 'on' => WorkflowScenario::enterStatus('ca-assign-reviewer')],
			
			//bt-assign-associate
			
			[['asgn_reviewer_by', 'asgn_reviewer_at'], 'required', 'on' => WorkflowScenario::enterStatus('da-review')],
			
			[['review_submit_at'], 'required', 'on' => WorkflowScenario::enterStatus('ga-response')],
			
			[['response_at', 'response_by', 'response_note', 'response_option'], 'required', 'on' => WorkflowScenario::enterStatus('ha-correction')],
			
			[['correction_at', 'correction_file'], 'required', 'on' => WorkflowScenario::enterStatus('ia-post-evaluate')],
			
			[['post_evaluate_at', 'post_evaluate_by', 'assistant_editor', 'doi_ref', 'page_from', 'page_to'], 'required', 'on' => WorkflowScenario::enterStatus('oa-camera-ready')],
			
			[['cameraready_file', 'camera_ready_at', 'camera_ready_by'], 'required', 'on' => WorkflowScenario::enterStatus('pa-assign-journal')],
			
			[['journal_issue_id'], 'required', 'on' => WorkflowScenario::enterStatus('qa-publish')],
			
			[['reject_at', 'reject_by', 'reject_note'], 'required', 'on' => WorkflowScenario::enterStatus('ra-reject')],
			
			[['withdraw_request_at', 'withdraw_note'], 'required', 'on' => WorkflowScenario::enterStatus('sa-withdraw-request')],
			
			[['withdraw_at', 'withdraw_by'], 'required', 'on' => WorkflowScenario::enterStatus('ta-withdraw')],
			
			[['publish_number'], 'required', 'on' => 'publish_number'],
			
           [['title', 'keyword', 'abstract', 'reference', 'pre_evaluate_note', 'response_note', 'correction_note', 'correction_file',  'cameraready_file', 'reject_note', 'publish_number', 'camera_ready_note', 'withdraw_note', 'payment_note', 'doi_ref'], 'string'],
			
            [['journal_id', 'journal_issue_id', 'pre_evaluate_by', 'asgn_reviewer_by', 'journal_by', 'scope_id', 'associate_editor', 'response_by', 'assistant_editor', 'withdraw_by', 'response_option', 'yearly_number', 'invoice_id', 'page_from', 'page_to'], 'integer'],
			
            [['draft_at', 'pre_evaluate_at', 'asgn_reviewer_at', 'evaluate_at', 'correction_at', 'post_evaluate_at', 'galley_proof_at', 'finalise_at', 'asgn_profrdr_at', 'post_finalise_at', 'proofread_at', 'camera_ready_at', 'journal_at', 'updated_at', 'review_at', 'recommend_at', 'response_at', 'withdraw_at', 'withdraw_request_at', 'submit_at', 'finalised_at', 'asgn_associate_at'], 'safe'],
			
            [['status'], 'string', 'max' => 100],
			
			[['correction_file', 'submission_file', 'cameraready_file'], 'string', 'max' => 200],
			
			//upload///
			
			[['submission_file'], 'required', 'on' => 'submission_upload'],
			[['submission_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'submission_delete'],
			
			[['payment_file'], 'required', 'on' => 'payment_upload'],
			[['payment_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,gif,pdf', 'maxSize' => 3000000],
			[['updated_at'], 'required', 'on' => 'payment_delete'],
			
			[['review_file'], 'required', 'on' => 'review_upload'],
			[['review_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'review_delete'],
			
			[['correction_file'], 'required', 'on' => 'correction_upload'],
			[['correction_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'correction_delete'],
			
			
			[['cameraready_file'], 'required', 'on' => 'cameraready_upload'],
			[['cameraready_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'cameraready_delete'],
			
        ];
    }
	
	public function behaviors()
    {
    	return [
			\raoul2000\workflow\base\SimpleWorkflowBehavior::className()
    	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'keyword' => 'Keyword',
            'abstract' => 'Abstract',
            'reference' => 'Reference',
			'scope_id' => 'Scope',
            'status' => 'Status',
            'journal_id' => 'Journal ID',
            'draft_at' => 'Draft At',
            'pre_evaluate_at' => 'Pre Evaluate At',
            'pre_evaluate_by' => 'Pre Evaluate By',
            'asgn_reviewer_at' => 'Asgn Reviewer At',
            'asgn_reviewer_by' => 'Asgn Reviewer By',
            'evaluate_by' => 'Evaluate By',
            'evaluate_at' => 'Evaluate At',
            'correction_at' => 'Correction At',

            'camera_ready_at' => 'Camera Ready At',
            'camera_ready_by' => 'Camera Ready By',
            'journal_at' => 'Journal At',
            'journal_by' => 'Journal By',
			'cameraready_file' => 'Camera Ready PDF File',
			'payment_file' => 'Upload Payment Evidence'
        ];
    }
	
	public function genYearlyNumber(){
		$curr_year = date('Y');
		$max = self::find()->
		select('MAX(yearly_number) as max_yearly')
		->where(['journal_id' => $this->journal_id, 'YEAR(draft_at)' =>  $curr_year])
		//->andWhere('<>', 'id', $this->id)
		->one();
		if($max){
			$kira = $max->max_yearly + 1;
			return $kira;
		}else{
			return 1;
		}
		
	}
	
	public function getArticleAuthors()
    {
        return $this->hasMany(ArticleAuthor::className(), ['article_id' => 'id']);
    }
	
	public function getArticleReviewers()
    {
        return $this->hasMany(ArticleReviewer::className(), ['article_id' => 'id']);
    }
	
	
	public function checkInProgressReviewers(){
		$list = $this->articleReviewers;
		if($list){
			foreach($list as $row){
				$status = $row->status;
				if($status == 0 or $status == 10){
					return true;
				}
			}
		}
		return false;
	}
	
	public function getCompletedReviewers()
    {
        return $this->hasMany(ArticleReviewer::className(), ['article_id' => 'id'])->where(['status' => 20]);
    }
	
	public function getAssignedReviewers()
    {
        return $this->hasMany(ArticleReviewer::className(), ['article_id' => 'id'])->where(['status' => 0]);
    }
	
	public function reviewCompleted(){
		
		$result = ArticleReviewer::find()
		->where(['article_id'=> $this->id, 'status' => 0])
		->all();
		
		if($result){
			return false;
		}else{
			return true;
		}
	}
	
	public function getMyReview()
    {
        return ArticleReviewer::findOne(['article_id' => $this->id, 'user_id' => Yii::$app->user->identity->id, 'status' => [0, 10, 20, 30]]);
    }
	
	public function getMyAppointedReview()
    {
        return ArticleReviewer::findOne(['article_id' => $this->id, 'user_id' => Yii::$app->user->identity->id, 'status' => 10]);
    }
	
	public function getMyCompletedReview()
    {
        return ArticleReviewer::findOne(['article_id' => $this->id, 'user_id' => Yii::$app->user->identity->id, 'status' => 20]);
    }
	
	public function getWfStatus(){
		$status = $this->getWorkflowStatus()->getId();
		/* $status = str_replace("ArticleWorkflow/","",$status);
		$status = explode('-', $status);
		$status = $status[1]; */
		return substr($status, 19);
	}
	
	
	public function getWfLabel(){
		$label = $this->getWorkflowStatus()->getLabel();
		$color = $this->getWorkflowStatus()->getMetadata('color');
		$format = '<span class="btn btn-outline-'.$color.' btn-sm">'.strtoupper($label).'</span>';
		return $format;
	}
	
	public function getWfLabelBack(){
		$label = $this->getWorkflowStatus()->getLabel();
		$color = $this->getWorkflowStatus()->getMetadata('color');
		$format = '<span class="label label-'.$color.'">'.strtoupper($label).'</span>';
		return $format;
	}
	
	public function getScope(){
		return $this->hasOne(Scope::className(), ['id' => 'scope_id']);
	}
	
	public function getScopeList(){
		return self::find()
        ->select('jeb_scope.id, jeb_scope.scope_name')
        ->innerJoin('jeb_journal_scope', 'jeb_journal_scope.journal_id = jeb_article.journal_id')
		->innerJoin('jeb_scope', 'jeb_scope.id = jeb_journal_scope.scope_id')
        ->orderBy('jeb_scope.scope_name ASC, ')
        ->all();
	}
	
	public function getJournal(){
		return $this->hasOne(Journal::className(), ['id' => 'journal_id']);
	}
	
	public function getInvoice(){
		return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
	}
	
	public function getReceipt(){
		return $this->hasOne(Receipt::className(), ['id' => 'receipt_id']);
	}
	
	public function getJournalIssue(){
		return $this->hasOne(JournalIssue::className(), ['id' => 'journal_issue_id']);
	}
	
	public function getIssueInfo(){
		$issue = $this->journalIssue;
		if($issue){
			return $issue->journalIssueName3;
		}
		
		
	}
	
	public function getArticleUrl(){
		if($this->journalIssue){
			$volume = $this->journalIssue->volume; 
			$len = strlen((string)$volume);
			if($len == 1){
				$volume = '0' . $volume;
			}
			$issue = $this->journalIssue->issue;
			$len = strlen((string)$issue);
			if($len == 1){
				$issue = '0' . $issue;
			}
			$web = $this->journal->journal_url;
			return $web.'/'.$volume . $issue .'.'. $this->publish_number;
		}else{
			return '';
		}
		
		
		
	}
	
	
	public function linkArticle(){
		$volume = '';
		$issue = '';
		if($this->journalIssue){
			$volume = $this->journalIssue->volume; 
			$len = strlen((string)$volume);
			if($len == 1){
				$volume = '0' . $volume;
			}
			$issue = $this->journalIssue->issue;
			$len = strlen((string)$issue);
			if($len == 1){
				$issue = '0' . $issue;
			}
		}
		
		return ['site/download', 'volume' => $volume, 'issue' => $issue, 'publish_number' => $this->publish_number];

	}
	
	
	public function getRecommedBy(){
		return $this->hasOne(User::className(), ['id' => 'recommend_by']);
	}
	
	public function getUser(){
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	
	public function getAssociateEditor(){
		return $this->hasOne(User::className(), ['id' => 'associate_editor']);
	}
	
	public function getAssignProofreaderBy(){
		return $this->hasOne(User::className(), ['id' => 'asgn_profrdr_by']);
	}
	
	public function getAssistantEditor(){
		return $this->hasOne(User::className(), ['id' => 'assistant_editor']);
	}
	public function getGalleyProofBy(){
		return $this->hasOne(User::className(), ['id' => 'galley_proof_by']);
	}
	
	public function getEvaluateOption(){
		return ReviewForm::reviewOptions()[$this->response_option];
	}
	
	public function getEvaluateBy(){
		return $this->hasOne(User::className(), ['id' => 'evaluate_by']);
	}
	
	public function getRejectBy(){
		return $this->hasOne(User::className(), ['id' => 'reject_by']);
	}
	
	public function getCameraReadyBy(){
		return $this->hasOne(User::className(), ['id' => 'camera_ready_by']);
	}
	public function getResponseBy(){
		return $this->hasOne(User::className(), ['id' => 'response_by']);
	}
	
	public function getPreEvaluateBy(){
		return $this->hasOne(User::className(), ['id' => 'pre_evaluate_by']);
	}
	
	public function getRecommendOption(){
		return ReviewForm::reviewOptions()[$this->recommend_option];
	}
	
	
	public function getAuthors(){
		$list = $this->articleAuthors;
		$str = '';
		if($list){
			foreach($list as $au){
				$str .= $au->firstname . ' ' . $au->lastname . '<br />';
			}
		}
		return $str;
	}
	
	public function isAssistantEditor(){
		if($this->assistant_editor == Yii::$app->user->identity->id){
			return true;
		}else{
			false;
		}
	}
	
	public function isReviewer(){
		$reviewer = ArticleReviewer::findOne(['user_id' => Yii::$app->user->identity->id, 'article_id' => $this->id]);
		if($reviewer){
			return true;
		}
		return false;
	}
	
	public function isCompletedReviewer(){
		$reviewer = ArticleReviewer::findOne(['user_id' => Yii::$app->user->identity->id, 'article_id' => $this->id, 'status' => 20]);
		if($reviewer){
			return true;
		}
		return false;
	}
	
	public function isAssociateEditor(){
		if($this->associate_editor == Yii::$app->user->identity->id){
			return true;
		}else{
			false;
		}
	}
	
	
	public function getStringAuthors(){
		$ar_authors = $this->articleAuthors;
		$str = '';
		if($ar_authors){
			$i = 1;
			foreach($ar_authors as $au){
				$comma = $i == 1 ? '' : ', ';
				$str .= $comma.$au->firstname . ' ' . $au->lastname;
			$i++;
			}
		}
		
		return $str;
	}
	
	public function manuscriptNo(){
		/* if($this->submit_at){
			if($this->submit_at == '0000-00-00 00:00:00' or $this->submit_at == 'NOW()'){
				$time = time();
			}else{
				$time = strtotime($this->submit_at);
			}
		}else{
			$time = time();
		}
		
		$year = date('Y', $time);
		return $year . '.' . $this->id; */
		$year = date('Y', strtotime($this->draft_at)) ;
		$journal = $this->journal->journal_abbr;
		$yearly_number = $this->yearly_number;
		$len = strlen((string)$yearly_number);
		if($len == 1){
			$yearly_number = '00'.$yearly_number;
		}else if($len == 2){
			$yearly_number = '0'.$yearly_number;
		}
		return $journal . '_'. $year.$yearly_number;
	}
	
	public function flashError(){
		if($this->getErrors()){
			foreach($this->getErrors() as $error){
				if($error){
					foreach($error as $e){
						Yii::$app->session->addFlash('error', $e);
					}
				}
			}
		}
	}
	
	
	public function sendReviewerEmail($user, $template){
		$emails = EmailTemplate::find()->where(['on_enter_workflow' => $template])->all();
		if($emails){
			foreach($emails as $email){
				if($user){
					$this->queueEmail($user, $email);
				}
			}
		}
	}
	
	public function sendEmail($custom = null){
		/* 			Yii::$app->session->addFlash('error', "no email_workflow property value");
			return false; */
			
		if($custom){
			$wf = $custom;
		}else{
			$wf = $this->getWorkflowStatus()->getId();
		}
		
		
		$emails = EmailTemplate::find()->where(['on_enter_workflow' => $wf])->all();

		if($emails){
			foreach($emails as $email){
				$target = json_decode($email->target_role);
				if($target){
					foreach($target as $assignment){
						if($assignment == 'journal-author'){
							$user = $this->user;
							$this->queueEmail($user, $email);
						}else if($assignment == 'journal-associate-editor'){
							$user = $this->associateEditor;
							if($user){
								$this->queueEmail($user, $email);
							}
						}else if($assignment == 'journal-assistant-editor'){
							$user = $this->assistantEditor;
							if($user){
								$this->queueEmail($user, $email);
							}
						}else if($assignment == 'journal-reviewer'){
							//sending to all reviwers
							$users = $this->assignedReviewers;
							if($users){
								foreach($users as $u){
									$user = User::findOne($u->user_id);
									$this->queueEmail($user, $email);
								}
							}
						}else if($assignment == 'journal-proof-reader'){
							$user = $this->proofReader;
							if($user){
								$this->queueEmail($user, $email);
							}
						}else if($assignment == 'journal-managing-editor' or $assignment == 'journal-editor-in-chief'){
							$users = AuthAssignment::getUsersByAssignment($assignment);
							if($users){
								foreach($users as $u){
									$user = User::findOne($u->user_id);
									$this->queueEmail($user, $email);
								}
							}
						}
					}
				}else{
					Yii::$app->session->addFlash('error', "no_target");
					return false;
				}
			}
			
		}
		
		
		
	}
	
	
	
	public function queueEmail($user, $email){
		
		$content = $this->emailContentReplace($email->notification, $user);
		$subject = $email->notification_subject;
		$subject = str_replace('{manuscript-number}', $this->manuscriptNo(), $subject);
		$subject = str_replace('{journal-abbr}', $this->journal->journal_abbr, $subject);
		
		
		return Yii::$app->mailqueue->compose()
		 ->setFrom(['auto.mail.esn@gmail.com' => $this->journal->journal_abbr . ' JOURNAL'])
		 ->setReplyTo($this->journal->journal_email)
		 ->setTo([$user->email => $user->fullname])
		 ->setTextBody($content)
		 ->setSubject($subject)
		 ->queue();
	}
	
	public function emailContentReplace($content, $user){
		$manuscript = "Manuscript Number: " . $this->manuscriptNo() . "\n\n" . "Title: " . $this->title . "\n\n" . "Abstract: " . $this->abstract . "\n\n" . "Keywords: " . $this->keyword;
		$manuscriptx = "Title: " . $this->title . "\n\n" . "Abstract: " . $this->abstract . "\n\n" . "Keywords: " . $this->keyword;
		
		$invoice = $this->invoice;
		if($invoice){
			$invoiceAmount = $this->invoice->invoiceAmount;
		}else{
			$invoiceAmount = 0;
		}
		
		$setting = Setting::getOne();
		
		$replaces = [
		'{manuscript-information}' => $manuscript,
		'{manuscript-information-x}' => $manuscriptx,
		'{manuscript-number}' => $this->manuscriptNo(),
		'{manuscript-title}' => $this->title,
		'{manuscript-abstract}' => $this->abstract,
		'{manuscript-keywords}' => $this->keyword,
		'{fullname}' => $user->fullname,
		'{email}' => $user->email,
		'{pre-evaluation-note}' =>  $this->pre_evaluate_note,
		'{response-note}' => $this->response_note,
		'{correction-note}' => $this->correction_note,
		'{reject-note}' => $this->reject_note,
		'{withdraw-note}' => $this->withdraw_note,
		'{journal-abbr}' => $this->journal->journal_abbr,
		'{journal-url}' => $this->journal->journal_url,
		'{journal-full-name}' => $this->journal->journalName,
		'{journal-address}' => $this->journal->journal_address,
		'{journal-phone1}' => $this->journal->phone1,
		'{journal-phone2}' => $this->journal->phone2,
		'{journal-email}' => $this->journal->journal_email,
		'{login-admin-url}' => $setting->admin_url,
		'{author-fee-amount}' => $invoiceAmount,
		'{payment-note}' => $this->payment_note,
		'{bank-name}' => $setting->bank_name,
		'{account-name}' => $setting->account_name,
		'{account-number}' => $setting->account_no,
		
		
		 
		];
		
		foreach($replaces as $key=>$r){
			$content = str_replace($key, $r, $content);
		}
	
		return $content;
	}
	
	

}
