<?php

namespace backend\modules\journal\models;

use Yii;

/**
 * This is the model class for table "jeb_journal".
 *
 * @property int $id
 * @property string $journal_name
 * @property string $journal_abbr
 * @property string $journal_url
 * @property string $created_at
 * @property string $updated_at
 */
class Journal extends \yii\db\ActiveRecord
{
	public $template_instance;
	public $template2_instance;
	public $file_controller;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_name','journal_name2', 'journal_abbr', 'journal_url', 'journal_address'], 'required'],
			
			['journal_email', 'email'],
			
            [['created_at', 'updated_at'], 'safe'],
			
            [['journal_name', 'journal_url', 'journal_issn', 'journal_doi'], 'string', 'max' => 200],
			
            [['journal_abbr', 'phone1', 'phone2'], 'string', 'max' => 100],
			
			[['editorial_board', 'submission_guideline', 'publication_ethics'], 'string'],
			
			[['template_file'], 'required', 'on' => 'template_upload'],
			
			[['template2_file'], 'required', 'on' => 'template2_upload'],
			
			
			
            [['template_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf', 'maxSize' => 5000000],
            [['updated_at'], 'required', 'on' => 'template_delete'],
			
			[['template2_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf', 'maxSize' => 5000000],
            [['updated_at'], 'required', 'on' => 'template2_delete'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_name' => 'Journal Name (Line1)',
			'journal_name2' => 'Journal Name (Line2)',
            'journal_abbr' => 'Journal Abbr',
            'journal_url' => 'Journal Url',
			'journal_issn' => 'Journal ISSN',
			'journal_doi' => 'Journal DOI',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
			'template_file' => 'Template File (EN)',
			'template2_file' => 'Template File (BM)',
        ];
    }
	
	public function getJournalName(){
		return $this->journal_name . ' ' . $this->journal_name2;
	}
	
	public function getCallingIssue(){
		return JournalIssue::findOne(['journal_id' => $this->id ,'status' => 0]);
	}
	
	public function getJournalScopes()
    {
        return $this->hasMany(JournalScope::className(), ['journal_id' => 'id']);
    }

	
	public function getCallingIssueName(){
		if($this->callingIssue){
			return $this->callingIssue->journalIssueName;
		}else{
			return ' -- In Progress -- ';
		}
	}
	
	public function getCallingVolumeIssue(){
		if($this->callingIssue){
			return $this->callingIssue->journalName;
		}else{
			return ' -- In Progress -- ';
		}
	}
	
	public function getCallingIssueName3(){
		if($this->callingIssue){
			return $this->callingIssue->journalIssueName3;
		}else{
			return ' -- In Progress -- ';
		}
	}
	public function getCallingSubmitStart(){
		if($this->callingIssue){
			return date('d.m.Y', strtotime($this->callingIssue->submit_start));
		}else{
			return ' .date. ';
		}
	}
	public function getCallingSubmitEnd(){
		if($this->callingIssue){
			return date('d.m.Y', strtotime($this->callingIssue->submit_end));
		}else{
			return ' .date. ';
		}
	}
	
	public function getCurrentIssue(){
		return JournalIssue::findOne(['journal_id' => $this->id ,'status' => 20]);
	}
}
