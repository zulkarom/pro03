<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_invoice_item".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $product_id
 * @property int $paper_id
 * @property string $description
 * @property string $price
 * @property double $quantity
 *
 * @property AccInvoice $invoice
 * @property Product $product
 */
class InvoiceItem extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_invoice_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_id', 'product_id', 'paper_id', 'description', 'price', 'quantity'], 'required', 'on' => 'paper_item'],
			
			
            [['invoice_id', 'product_id', 'paper_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
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
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
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
