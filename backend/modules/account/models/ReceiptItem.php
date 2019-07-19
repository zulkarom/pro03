<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_receipt_item".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $product_id
 * @property int $paper_id
 * @property string $description
 * @property string $price
 * @property double $quantity
 */
class ReceiptItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_receipt_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			
			
			[['receipt_id', 'product_id', 'description', 'price', 'quantity'], 'required', 'on' => 'paper_item'],
			
            [['invoice_id', 'product_id', 'paper_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_id' => 'Receipt ID',
            'product_id' => 'Product ID',
            'paper_id' => 'Paper ID',
            'description' => 'Description',
            'price' => 'Price',
            'quantity' => 'Quantity',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::className(), ['id' => 'receipt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	
	public function flashError(){
        if($this->getErrors()){
            foreach($this->getErrors() as $error){
                if($error){
                    foreach($error as $e){
                        Yii::$app->session->addFlash('error', $e);
                    }
                }
            }
        }

    }
}
