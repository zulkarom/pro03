<?php

namespace backend\modules\journal\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "jeb_user_scope".
 *
 * @property int $id
 * @property int $user_id
 * @property int $scope_id
 */
class UserScope extends \yii\db\ActiveRecord
{
	public $fullname;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_user_scope';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'scope_id'], 'required'],
            [['user_id', 'scope_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'scope_id' => 'Scope ID',
        ];
    }
	
	public function getScope(){
        return $this->hasOne(Scope::className(), ['id' => 'scope_id']);
    }
	
	public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public static function listReviewers($scope){
		$reviewers = [];
			$reviewers =  self::find()
			->innerJoin('auth_assignment', 'auth_assignment.user_id = jeb_user_scope.user_id' )
			->where(['scope_id' => $scope, 'auth_assignment.item_name' => 'journal-reviewer'])
			->all();
		
		
		$arr = [];
		
		if($reviewers){
			foreach($reviewers as $reviewer){
				$arr[$reviewer->user_id] = $reviewer->user->fullname;
			}
		}
		
		return $arr;
	}
	


}
