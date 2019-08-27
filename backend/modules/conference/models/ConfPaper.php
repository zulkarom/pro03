<?php

namespace backend\modules\conference\models;

use Yii;
use common\models\User;


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
            [['conf_id', 'user_id', 'pap_title', 'pap_abstract', 'created_at'], 'required', 'on' => 'create'],
			
            [['conf_id', 'user_id'], 'integer'],
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
            'pap_abstract' => 'Abstract',
            'paper_file' => 'Upload File',
            'created_at' => 'Created At',
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
}
