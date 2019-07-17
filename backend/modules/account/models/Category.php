<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_category".
 *
 * @property int $id
 * @property string $cat_name
 * @property int $main_cat
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name', 'main_cat'], 'required'],
            [['main_cat'], 'integer'],
            [['cat_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => 'Cat Name',
            'main_cat' => 'Main Cat',
        ];
    }
}
