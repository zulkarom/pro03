<?php

namespace backend\modules\conference\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "conference".
 *
 * @property int $id
 * @property string $conf_name
 * @property string $conf_abbr
 * @property string $date_start
 * @property string $conf_venue
 * @property string $conf_url
 */
class Conference extends \yii\db\ActiveRecord
{
	public $banner_instance;
	public $file_controller;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conference';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conf_name', 'conf_abbr', 'date_start', 'conf_venue', 'conf_url', 'user_id'], 'required'],
			
            [['date_start','date_end', 'updated_at', 'created_at'], 'safe'],
			
            [['conf_name', 'conf_venue'], 'string', 'max' => 200],
			
			 [['conf_background', 'conf_scope', 'conf_lang', 'conf_publication', 'conf_contact', 'conf_submission', 'payment_info', 'announcement', 'conf_accommodation', 'conf_award', 'conf_committee'], 'string'],
			 
			 [['currency_local', 'currency_int'], 'string', 'max' => 10],
			
            [['conf_abbr'], 'string', 'max' => 50],
            [['conf_url'], 'string', 'max' => 100],
			[['conf_url'], 'unique'],
			
			[['user_id', 'created_by'], 'integer'],
			
			[['banner_file'], 'required', 'on' => 'banner_upload'],
            [['banner_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'maxSize' => 2000000],
            [['updated_at'], 'required', 'on' => 'banner_delete'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conf_name' => 'Conference Name',
            'conf_abbr' => 'Conference Abbr',
            'date_start' => 'Conference Date',
            'conf_venue' => 'Conference Venue',
            'conf_url' => 'Conference Url',
			'user_id' => 'Manager',
			'currency_int' => 'International Currency',
			'currency_local' => 'Local Currency',
			
        ];
    }
	
	public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function getConferenceDate($sep = ' - '){
		if(($this->date_start == $this->date_end) or ($this->date_end == '0000-00-00')){
			return date('d M Y', strtotime($this->date_start));
		}else{
			return date('d M Y', strtotime($this->date_end)) . $sep . date('d M Y', strtotime($this->date_end));
		}
	}
	
	public function getConfDates()
    {
        return $this->hasMany(ConfDate::className(), ['conf_id' => 'id'])->orderBy('date_order ASC');
    }
	
	public function getConfDownloads()
    {
        return $this->hasMany(ConfDownload::className(), ['conf_id' => 'id'])->orderBy('download_order ASC');
    }
	
	public function getConfFees()
    {
        return $this->hasMany(ConfFee::className(), ['conf_id' => 'id'])->orderBy('fee_order ASC');
    }
	
	public function getConfRegistrations()
    {
        return $this->hasMany(ConfRegistration::className(), ['conf_id' => 'id']);
    }
	
	public function getConfPapers()
    {
        return $this->hasMany(ConfPaper::className(), ['conf_id' => 'id']);
    }
	
	public function getTentativeDays()
    {
        return $this->hasMany(TentativeDay::className(), ['conf_id' => 'id']);
    }
	
	public function getPages(){
		return [
			'conf_background' => ['Background', 'background'], 
			'conf_scope' => ['Conference Scope', 'scope'], 
			'conf_submission' => ['Registration & Submission', 'submission'], 
			'dates' => ['Important Dates', 'dates'], 
			'fees' => ['Fees & Payment', 'fees'],
			'conf_publication' =>['Publication', 'publication'], 
			'conf_award' => ['Award', 'award'],
			'conf_accommodation' => ['Venue & Accommodation', 'accommodation'], 
			'tentative' => ['Tentative', 'tentative'], 
			'conf_committee' => ['Committee', 'committee'], 
			'conf_lang' => ['Language', 'language'], 
			'conf_contact' => ['Contact Person', 'contact']
		];
	}
	
	public function getUserCount(){
		$kira = ConfRegistration::find()->where(['conf_id' => $this->id])->count();
		return $kira ? $kira : 0;
	}
	
	public function getPaperCount(){
		$kira = ConfPaper::find()->where(['conf_id' => $this->id])->count();
		return $kira ? $kira : 0;
	}
	
	public function getPaperCountAbstract(){
		$kira = ConfPaper::find()->where(['conf_id' => $this->id, 'status' => [30, 40]])->count();
		return $kira ? $kira : 0;
	}
	
	public function getPaperCountFullPaper(){
		$kira = ConfPaper::find()->where(['conf_id' => $this->id, 'status'=> [35,50]])->count();
		return $kira ? $kira : 0;
	}
	
	public function getPaperCountReview(){
		$kira = ConfPaper::find()->where(['conf_id' => $this->id, 'status'=> [60, 70]])->count();
		return $kira ? $kira : 0;
	}
	
	public function getPaperCountPayment(){
		$kira = ConfPaper::find()->where(['conf_id' => $this->id, 'status'=> [80, 90]])->count();
		return $kira ? $kira : 0;
	}


}
