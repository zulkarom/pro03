<?php

namespace backend\modules\journal\models;

use Yii;

/**
 * This is the model class for table "jeb_scope_cat".
 *
 * @property int $id
 * @property string $cat_name
 */
class ScopeCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jeb_scope_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => 'Category',
        ];
    }
}
