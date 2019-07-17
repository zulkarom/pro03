<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_account".
 *
 * @property int $id
 * @property string $acc_name
 * @property int $category
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acc_name', 'category'], 'required'],
            [['category'], 'integer'],
            [['acc_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acc_name' => 'Acc Name',
            'category' => 'Category',
        ];
    }
}
