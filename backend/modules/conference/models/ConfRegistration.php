<?php

namespace backend\modules\conference\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "conf_reg".
 *
 * @property int $id
 * @property int $conf_id
 * @property int $user_id
 * @property string $reg_at
 *
 * @property Conference $conf
 */
class ConfRegistration extends \yii\db\ActiveRecord
{
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conf_reg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conf_id', 'user_id', 'reg_at'], 'required'],
            [['conf_id', 'user_id'], 'integer'],
            [['reg_at'], 'safe'],
            [['conf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conference::className(), 'targetAttribute' => ['conf_id' => 'id']],
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
            'reg_at' => 'Registration Time',
        ];
    }
	
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConference()
    {
        return $this->hasOne(Conference::className(), ['id' => 'conf_id']);
    }
	
	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
