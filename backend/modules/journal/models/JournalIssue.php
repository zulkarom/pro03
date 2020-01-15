<?php

namespace backend\modules\journal\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jeb_journal".
 *
 * @property int $id
 * @property int $volume
 * @property int $issue
 * @property int $status
 * @property string $description
 * @property string $published_at
 * @property string $archived_at
 */
class JournalIssue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_journal_issue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['volume', 'issue', 'issue_month', 'issue_year', 'journal_id'], 'required', 'on' => 'create'],
			
            [['volume', 'issue', 'status', 'journal_id'], 'integer'],
			
            [['description' , 'issue_month'], 'string'],
			
            [['publish_date', 'published_at', 'archived_at', 'issue_year', 'submit_start', 'submit_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'volume' => 'Volume',
            'issue' => 'Issue',
            'status' => 'Status',
            'description' => 'Description',
            'published_at' => 'Published At',
            'archived_at' => 'Archived At',
        ];
    }
	
	public function journalStatus(){
		return [ 0 => 'Compiling', 10 => 'Forthcomming', 20 => 'Current Issue', 30 => 'Archived'];
	}
	
	public function statusLabel(){
		$status = $this->status;
		$color = 'warning';
		switch($status){
			case 20:$color = 'success';break;
			case 10:$color = 'info';break;
			case 30:$color = 'danger';break;
		}
		
		return '<span class="btn btn-outline-'.$color.' btn-sm">'.strtoupper($this->journalStatus()[$status]).'</span>';

		
	}
	
	public static function listCompilingJournal($journal_id){
		return self::find()->where(['status' => 0, 'journal_id' => $journal_id])->limit(100)->all();
	}
	
	public static function listArchiveJournal(){
		return self::find()->where(['status' => 30])->all();
	}
	
	
	public function getJournalName(){
		return 'Volume ' . $this->volume . ' Issue ' . $this->issue;
	}
	
	public function getJournalIssueName(){
		$journal = $this->journal->journal_abbr;
		
		return $journal . ' Volume ' . $this->volume . ' Issue ' . $this->issue. ' ' . $this->issue_month . ' ' . $this->issue_year ;
	}
	
	public function getJournalIssueName2(){
		$journal = $this->journal->journal_abbr;
		
		return $this->issue_month . ' ' . $this->issue_year . ' Volume ' . $this->volume . ' Issue ' . $this->issue;
	}
	public function getJournalIssueName3(){
		$journal = $this->journal->journal_abbr;
		
		return 'Volume ' . $this->volume . ' Issue ' . $this->issue .' '. $this->issue_month . ' ' . $this->issue_year ;
	}
	
	public function getJournal(){
		return $this->hasOne(Journal::className(), ['id' => 'journal_id']);
	}
	
	public function getArticles()
    {
        return $this->hasMany(Article::className(), ['journal_issue_id' => 'id'])->orderBy('publish_number ASC');
    }
	
	public function getMonthList(){
		$arr = ['March', 'June', 'September', 'December'];
		$month = [];
		foreach($arr as $a){
			$month[$a] = $a;
		}
		
		return $month;
		
	}
	
	public static function listIssues($journal){
		$result = JournalIssue::find()->where(['journal_id' => $journal])
		->all();
		return ArrayHelper::map($result, 'id', 'journalIssueName');
	}

	
	
}
