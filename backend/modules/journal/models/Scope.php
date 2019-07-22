<?php

namespace backend\modules\journal\models;

use Yii;

/**
 * This is the model class for table "jeb_scope".
 *
 * @property int $id
 * @property string $scope_name
 */
class Scope extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jeb_scope';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scope_name'], 'required'],
			[['scope_name'], 'unique'],
            [['scope_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope_name' => 'Scope Name',
        ];
    }
}
