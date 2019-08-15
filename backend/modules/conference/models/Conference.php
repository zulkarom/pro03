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
            [['date_start', 'updated_at', 'created_at'], 'safe'],
			
            [['conf_name', 'conf_venue'], 'string', 'max' => 200],
			
			 [['conf_background', 'conf_scope', 'conf_lang', 'conf_publication', 'conf_contact', 'conf_submission', 'payment_info'], 'string'],
			
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
        ];
    }
	
	public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function getConfDates()
    {
        return $this->hasMany(ConfDate::className(), ['conf_id' => 'id'])->orderBy('date_order ASC');
    }


}
