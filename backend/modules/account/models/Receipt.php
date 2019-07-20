<?php

namespace backend\modules\account\models;

use Yii;
use backend\modules\journal\models\Setting;
use yii\db\Expression;
use common\models\User;
/**
 * This is the model class for table "acc_receipt".
 *
 * @property int $id
 * @property string $summary
 * @property string $receipt_date
 * @property string $due_date
 * @property int $client_id
 * @property int $status
 * @property string $discount
 * @property string $gst
 * @property string $note
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $trash
 * @property string $token
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			
			[['receipt_date', 'client_id', 'note', 'invoice_id','created_by', 'created_at'], 'required', 'on' => 'create'],
			
			
            [['summary', 'note'], 'string'],
            [['invoice_date', 'due_date', 'created_at', 'updated_at'], 'safe'],
            [['client_id', 'status', 'invoice_id', 'created_by', 'trash'], 'integer'],
            [['discount', 'gst'], 'number'],
            [['token'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summary' => 'Summary',
            'invoice_date' => 'Invoice Date',
            'due_date' => 'Due Date',
            'client_id' => 'Client ID',
            'status' => 'Status',
            'discount' => 'Discount',
            'gst' => 'Gst',
            'note' => 'Note',
            'quotation_id' => 'Quotation ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'trash' => 'Trash',
            'token' => 'Token',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiptItems()
    {
        return $this->hasMany(ReceiptItem::className(), ['receipt_id' => 'id']);
    }
	
	public function getReceiptAmount(){
		$items = $this->receiptItems;
		$amount = 0;
		if($items){
			foreach($items as $item){
				$sub = $item->price * $item->quantity;
				$amount +=$sub;
			}
		}
		
		return $amount;
	}
	
	
	public function getClient(){
        return $this->hasOne(User::className(), ['id' => 'client_id']);
    }
	
	public function getCreatedBy(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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

	
	
	public static function createReceipt($article){
		$setting = Setting::getOne();
		$tran = new Transaction;
		$tran->tran_date =  date('Y-m-d');
		$tran->debit = 2; //cash
		$tran->credit = 18; //journal fee
		$tran->assoc_client = $article->user_id;
		$tran->created_by = Yii::$app->user->identity->id;
		$tran->created_at = new Expression('NOW()');
		if($tran->save()){
			$receipt = new Receipt;
			$receipt->scenario = 'create';
			$receipt->tran_id = $tran->id;
			$receipt->receipt_date = date('Y-m-d');
			$receipt->invoice_id = $article->invoice_id;
			$receipt->client_id = $article->user_id;
			$receipt->note = $setting->receipt_note;
			$receipt->created_by = Yii::$app->user->identity->id;
			$receipt->created_at = new Expression('NOW()');
			if($receipt->save()){
				$item = new ReceiptItem;
				$item->scenario = 'paper_item';
				$item->receipt_id = $receipt->id;
				$item->product_id = 1;
				$item->paper_id = $article->id;
				$item->description = 'Payment Receipt for manuscript fee "'.$article->title .'"';
				$item->price = $article->invoice->invoiceAmount;
				$item->quantity = 1;
				if($item->save()){
					//update transaction
					$tran->amount = $receipt->receiptAmount;
					$tran->save();
					return $receipt->id;
				}else{
					$item->flashError();
				}
		}else{
			$tran->flashError();
		}
				
		
		}else{
			$receipt->flashError();
		}
	return false;
	}
}
