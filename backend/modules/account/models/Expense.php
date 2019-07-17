<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_expense".
 *
 * @property int $id
 * @property string $exp_date
 * @property int $tran_id
 * @property int $tran_payment
 * @property int $user_id
 * @property string $description
 * @property string $staff_contact
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exp_date', 'tran_id', 'tran_payment', 'user_id', 'description', 'staff_contact'], 'required'],
            [['exp_date'], 'safe'],
            [['tran_id', 'tran_payment', 'user_id'], 'integer'],
            [['description', 'staff_contact'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exp_date' => 'Exp Date',
            'tran_id' => 'Tran ID',
            'tran_payment' => 'Tran Payment',
            'user_id' => 'User ID',
            'description' => 'Description',
            'staff_contact' => 'Staff Contact',
        ];
    }
}
