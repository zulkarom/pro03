<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property int $user_id
 * @property int $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
	public $text;
	public $userid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }
	
	public function getUser(){
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	
	public static function getUsersByAssignment($assignment){
		return self::find()
		->leftJoin('user', 'user.id = auth_assignment.user_id')
		->where(['item_name' => $assignment])
		->all();
	}
	
	public static function getUsersByAssignmentArray($assignment){
		$result =  self::find()
		->select(['user.id AS userid', 'concat(fullname, " - ", email) AS text'])
		->leftJoin('user', 'user.id = auth_assignment.user_id')
		->where(['item_name' => $assignment])
		->all();
		
		return ArrayHelper::map($result, 'userid', 'text');
		
	}
}
