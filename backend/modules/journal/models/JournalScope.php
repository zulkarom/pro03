<?php

namespace backend\modules\journal\models;

use Yii;

/**
 * This is the model class for table "article_scope".
 *
 * @property int $id
 * @property string $scope_name
 */
class JournalScope extends \yii\db\ActiveRecord
{
	public $scope_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_journal_scope';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope_id', 'journal_id', 'scope_cat'], 'required'],
            [['scope_id', 'journal_id', 'scope_cat'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope_id' => 'Scope',
			'scope_cat' => 'Category',
        ];
    }
	
	public function getScope(){
		return $this->hasOne(Scope::className(), ['id' => 'scope_id']);
	}
	
	public function getScopeCat(){
		return $this->hasOne(ScopeCat::className(), ['id' => 'scope_cat']);
	}
	
	public static function listScopeByJournal($journal_id){
		$list = self::find()
		->select('jeb_scope.id, jeb_scope.scope_name')
		->innerJoin(['jeb_scope', 'jeb_scope.id', 'jeb_journal_scope.scope_id'])
		->where(['jeb_journal_scope.journal_id' => $journal_id])
		->all();
		$array = [];
		foreach($list as $val){
			$array[$val->id] = $val->scope_name;
		}
		return $array;
	}
}
