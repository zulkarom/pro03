<?php

namespace backend\modules\journal\models;

use Yii;
use common\models\workflows\ArticleWorkflow;

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
class ArticleOverwrite extends \yii\db\ActiveRecord
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
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jeb_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_id', 'user_id'], 'required'],
			
			
            [['journal_id', 'yearly_number', 'user_id', 'scope_id', 'pre_evaluate_by', 'invoice_id', 'associate_editor', 'asgn_reviewer_by', 'response_by', 'response_option', 'post_evaluate_by', 'assistant_editor', 'camera_ready_by', 'journal_by', 'journal_issue_id', 'reject_by', 'withdraw_by', 'page_from', 'page_to'], 'integer'],
			
            [['title', 'keyword', 'abstract', 'reference', 'payment_file', 'payment_note', 'pre_evaluate_note', 'response_note', 'correction_note', 'camera_ready_note', 'reject_note', 'withdraw_note'], 'string'],
			
            [['updated_at', 'draft_at', 'submit_at', 'pre_evaluate_at', 'asgn_reviewer_at', 'asgn_associate_at', 'review_at', 'review_submit_at', 'response_at', 'correction_at', 'post_evaluate_at', 'camera_ready_at', 'assign_journal_at', 'journal_at', 'reject_at', 'withdraw_at', 'withdraw_request_at'], 'safe'],
			
            [['manuscript_no', 'submission_file', 'review_file', 'cameraready_file', 'doi_ref'], 'string', 'max' => 200],
			
            [['status', 'correction_file', 'withdraw_at_status'], 'string', 'max' => 100],
            [['publish_number'], 'string', 'max' => 10],
			
            [['manuscript_no'], 'unique'],
			
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
			
			[['galley_file'], 'required', 'on' => 'galley_upload'],
			[['galley_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'galley_delete'],
			
			[['finalise_file'], 'required', 'on' => 'finalise_upload'],
			[['finalise_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'finalise_delete'],
			
			[['proofread_file'], 'required', 'on' => 'proofread_upload'],
			[['proofread_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'proofread_delete'],
			
			[['postfinalise_file'], 'required', 'on' => 'postfinalise_upload'],
			[['postfinalise_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'postfinalise_delete'],
			
			[['cameraready_file'], 'required', 'on' => 'cameraready_upload'],
			[['cameraready_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 5000000],
			[['updated_at'], 'required', 'on' => 'cameraready_delete'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_id' => 'Journal ID',
            'manuscript_no' => 'Manuscript No',
            'yearly_number' => 'Yearly Number',
            'user_id' => 'User ID',
            'pay_amount' => 'Pay Amount',
            'is_paid' => 'Is Paid',
            'title' => 'Title',
            'keyword' => 'Keyword',
            'abstract' => 'Abstract',
            'reference' => 'Reference',
            'scope_id' => 'Scope ID',
            'status' => 'Status',
            'submission_file' => 'Submission File',
            'updated_at' => 'Updated At',
            'draft_at' => 'Draft At',
            'submit_at' => 'Submit At',
            'pre_evaluate_at' => 'Pre Evaluate At',
            'pre_evaluate_by' => 'Pre Evaluate By',
            'payment_submit_at' => 'Payment Submit At',
            'payment_file' => 'Payment File',
            'payment_note' => 'Payment Note',
            'payment_amount' => 'Payment Amount',
            'payment_verified_at' => 'Payment Verified At',
            'associate_editor' => 'Associate Editor',
            'review_file' => 'Review File',
            'pre_evaluate_note' => 'Pre Evaluate Note',
            'asgn_reviewer_at' => 'Asgn Reviewer At',
            'asgn_associate_at' => 'Asgn Associate At',
            'asgn_reviewer_by' => 'Asgn Reviewer By',
            'review_at' => 'Review At',
            'review_submit_at' => 'Review Submit At',
            'recommend_by' => 'Recommend By',
            'recommend_at' => 'Recommend At',
            'recommend_note' => 'Recommend Note',
            'recommend_option' => 'Recommend Option',
            'evaluate_option' => 'Evaluate Option',
            'evaluate_note' => 'Evaluate Note',
            'evaluate_by' => 'Evaluate By',
            'evaluate_at' => 'Evaluate At',
            'response_by' => 'Response By',
            'response_at' => 'Response At',
            'response_note' => 'Response Note',
            'response_option' => 'Response Option',
            'correction_at' => 'Correction At',
            'correction_note' => 'Correction Note',
            'correction_file' => 'Correction File',
            'post_evaluate_by' => 'Post Evaluate By',
            'post_evaluate_at' => 'Post Evaluate At',
            'assistant_editor' => 'Assistant Editor',
            'galley_proof_at' => 'Galley Proof At',
            'galley_proof_by' => 'Galley Proof By',
            'galley_proof_note' => 'Galley Proof Note',
            'galley_file' => 'Galley File',
            'finalise_at' => 'Finalise At',
            'finalise_option' => 'Finalise Option',
            'finalise_note' => 'Finalise Note',
            'finalise_file' => 'Finalise File',
            'asgn_profrdr_at' => 'Asgn Profrdr At',
            'asgn_profrdr_by' => 'Asgn Profrdr By',
            'asgn_profrdr_note' => 'Asgn Profrdr Note',
            'proof_reader' => 'Proof Reader',
            'post_finalise_at' => 'Post Finalise At',
            'post_finalise_by' => 'Post Finalise By',
            'postfinalise_file' => 'Postfinalise File',
            'post_finalise_note' => 'Post Finalise Note',
            'proofread_at' => 'Proofread At',
            'proofread_by' => 'Proofread By',
            'proofread_note' => 'Proofread Note',
            'proofread_file' => 'Proofread File',
            'camera_ready_at' => 'Camera Ready At',
            'camera_ready_by' => 'Camera Ready By',
            'camera_ready_note' => 'Camera Ready Note',
            'cameraready_file' => 'Cameraready File',
            'assign_journal_at' => 'Assign Journal At',
            'journal_at' => 'Journal At',
            'journal_by' => 'Journal By',
            'journal_issue_id' => 'Journal Issue ID',
            'reject_at' => 'Reject At',
            'reject_by' => 'Reject By',
            'reject_note' => 'Reject Note',
            'publish_number' => 'Publish Number',
            'doi_ref' => 'Doi Ref',
            'withdraw_by' => 'Withdraw By',
            'withdraw_at_status' => 'Withdraw At Status',
            'withdraw_at' => 'Withdraw At',
            'withdraw_note' => 'Withdraw Note',
            'withdraw_request_at' => 'Withdraw Request At',
        ];
    }
	
	public function getAssociateEditor(){
		return $this->hasOne(User::className(), ['id' => 'associate_editor']);
	}
	
	public function getWfLabel(){
		$status = $this->getWfStatus();
		
		$format = '<span class="btn btn-outline-primary btn-sm">'.strtoupper($status).'</span>';
		return $format;
	}
	
	public function getJournal(){
		return $this->hasOne(Journal::className(), ['id' => 'journal_id']);
	}
	
	public function getWfStatus(){
		$status = $this->status;
		/* $status = str_replace("ArticleWorkflow/","",$status);
		$status = explode('-', $status);
		$status = $status[1]; */
		return substr($status, 19);
	}
	
	public function getArticleAuthors()
    {
        return $this->hasMany(ArticleAuthor::className(), ['article_id' => 'id']);
    }
}
