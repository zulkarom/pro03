<?php

namespace backend\modules\conference\models;

use Yii;
use common\models\User;
use yii\helpers\Html;


/**
 * This is the model class for table "conf_paper".
 *
 * @property int $id
 * @property int $conf_id
 * @property int $user_id
 * @property string $pap_title
 * @property string $pap_abstract
 * @property string $paper_file
 * @property string $created_at
 *
 * @property Conference $conf
 * @property User $user
 */
class ConfPaper extends \yii\db\ActiveRecord
{
	public $paper_instance;
	public $file_controller;
	public $form_abstract_only = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conf_paper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conf_id', 'user_id', 'pap_title', 'pap_abstract', 'created_at', 'status', 'keyword'], 'required', 'on' => 'create'],
			
			[['conf_id', 'user_id', 'pap_title', 'pap_abstract', 'created_at', 'status', 'paper_file', 'keyword'], 'required', 'on' => 'fullpaper'],
			
            [['conf_id', 'user_id', 'status', 'form_abstract_only'], 'integer'],
            [['pap_title', 'pap_abstract', 'paper_file'], 'string'],
            [['created_at'], 'safe'],
            [['conf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conference::className(), 'targetAttribute' => ['conf_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			
			[['paper_file'], 'required', 'on' => 'paper_upload'],
            [['paper_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxSize' => 5000000],
            [['updated_at'], 'required', 'on' => 'paper_delete'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conf_id' => 'Conf ID',
            'user_id' => 'User ID',
            'pap_title' => 'Title',
			'keyword' => 'Keywords',
			'status' => 'Status',
            'pap_abstract' => 'Abstract',
            'paper_file' => 'Upload Full Paper',
            'created_at' => 'Created At',
			'form_abstract_only' => 'Choose One:'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConference()
    {
        return $this->hasOne(Conference::className(), ['id' => 'conf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function getAuthors()
    {
        return $this->hasMany(ConfAuthor::className(), ['paper_id' => 'id'])->orderBy('author_order ASC');
    }
	
	public function authorString($break = '<br />'){
		$authors = $this->authors;
		$str = '';
		if($authors){
			$i = 1;
			foreach($authors as $au){
				$br = $i == 1 ? '' :  $break;
				$str .= $br. Html::encode($au->fullname);
			$i++;
			}
		}
		return $str;
	}
	
	public function getPaperStatus(){
		$statuses = $this->statusList();
		$code = $this->status;
		if(array_key_exists($code, $statuses)){
			return $statuses[$code];
		}else{
			return '';
		}
		
	}
	
	public function statusList(){
		return [
			0 => 'DRAFT',
			10 => 'REJECTED',
			20 => 'WITHDRAWN',
			30 => 'ABSTRACT SUBMISSION',
			35 => 'ABSTRACT & PAPER SUBMISSION',
			40 => 'ABSTRACT ACCEPTED',
			50 => 'FULL PAPER SUBMISSION',
			60 => 'PAPER REVIEW',
			70 => 'PAPER CORRECTION',
			80 => 'PAPER ACCEPTED',
			90 => 'CONFERENCE PAYMENT',
			100 => 'COMPLETE',
			
		];
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


}
