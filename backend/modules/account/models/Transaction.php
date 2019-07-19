<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_transaction".
 *
 * @property int $id
 * @property string $tran_date
 * @property int $debit
 * @property int $credit
 * @property string $amount
 * @property int $medium
 * @property string $reference
 * @property string $description
 * @property int $assoc_staff
 * @property int $assoc_client
 * @property int $assoc_tran
 * @property int $created_by
 * @property string $created_at
 * @property string $modified_at
 * @property int $trash
 * @property int $trashed_by
 * @property string $trashed_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tran_date', 'debit', 'credit', 'amount', 'medium', 'reference', 'description', 'assoc_staff', 'assoc_client', 'assoc_tran', 'created_by', 'created_at', 'modified_at', 'trash', 'trashed_by', 'trashed_at'], 'required'],
            [['tran_date', 'created_at', 'modified_at', 'trashed_at'], 'safe'],
            [['debit', 'credit', 'medium', 'assoc_staff', 'assoc_client', 'assoc_tran', 'created_by', 'trash', 'trashed_by'], 'integer'],
            [['amount'], 'number'],
            [['description'], 'string'],
            [['reference'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tran_date' => 'Tran Date',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'amount' => 'Amount',
            'medium' => 'Medium',
            'reference' => 'Reference',
            'description' => 'Description',
            'assoc_staff' => 'Assoc Staff',
            'assoc_client' => 'Assoc Client',
            'assoc_tran' => 'Assoc Tran',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'trash' => 'Trash',
            'trashed_by' => 'Trashed By',
            'trashed_at' => 'Trashed At',
        ];
    }
}
