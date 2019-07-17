<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_main_cat".
 *
 * @property int $id
 * @property string $main_name
 */
class MainCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_main_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_name'], 'required'],
            [['main_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_name' => 'Main Name',
        ];
    }
}
