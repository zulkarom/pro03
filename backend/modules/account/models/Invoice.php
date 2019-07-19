<?php

namespace backend\modules\account\models;

use Yii;
use common\models\User;
use backend\modules\journal\models\Article;
use backend\modules\journal\models\Setting;
use yii\db\Expression;

/**
 * This is the model class for table "acc_invoice".
 *
 * @property int $id
 * @property string $summary
 * @property string $invoice_date
 * @property string $due_date
 * @property int $client_id
 * @property int $status
 * @property string $discount
 * @property string $gst
 * @property string $note
 * @property int $quotation_id
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $trash
 * @property string $token
 *
 * @property InvoiceItem[] $invoiceItems
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_date', 'client_id', 'note', 'created_by', 'created_at', 'tran_id'], 'required', 'on' => 'create'],
			
            [['summary', 'note'], 'string'],
            [['invoice_date', 'due_date', 'created_at', 'updated_at'], 'safe'],
            [['client_id', 'status', 'quotation_id', 'created_by', 'trash'], 'integer'],
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
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['invoice_id' => 'id']);
    }
	
	public function getInvoiceAmount(){
		$items = $this->invoiceItems;
		$amount = 0;
		if($items){
			foreach($items as $item){
				$sub = $item->price * $item->quantity;
				$amount +=$sub;
			}
		}
		
		return $amount;
	}
	
	public function statusLabels(){
		return [0 => 'Unpaid', 10 => 'Paid'];
	}
	public function statusColor(){
		return [0 => 'danger', 10 => 'success'];
	}
	
	public function statusText(){
		$label = $this->statusLabels();
		return $label[$this->status];
	}
	
	public function getStatusButton(){
		$text = $this->statusText();
		$color = $this->statusColor()[$this->status];
		return '<span class="btn btn-outline-'.$color.' btn-sm">'.strtoupper($text).'</span>';
		
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

	
	
	public static function createInvoice($article){
		$setting = Setting::getOne();
		
		$tran = new Transaction;
		$tran->scenario = 'create_invoice';
		$tran->tran_date =  date('Y-m-d');
		$tran->debit = 18; //client Debtors
		$tran->credit = 17; //journal fee
		$tran->assoc_client = $article->user_id;
		$tran->created_by = Yii::$app->user->identity->id;
		$tran->created_at = new Expression('NOW()');
		if($tran->save()){
			$invoice = new Invoice;
			$invoice->scenario = 'create';
			$invoice->invoice_date = date('Y-m-d');
			$invoice->tran_id = $tran->id;
			$invoice->client_id = $article->user_id;
			$invoice->note = $setting->invoice_note;
			$invoice->created_by = Yii::$app->user->identity->id;
			$invoice->created_at = new Expression('NOW()');
			if($invoice->save()){
				$item = new InvoiceItem;
				$item->scenario = 'paper_item';
				$item->invoice_id = $invoice->id;
				$item->product_id = 1;
				$item->paper_id = $article->id;
				$item->description = 'Journal Fee for manuscript "'.$article->title .'"';
				$item->price = $article->pay_amount;
				$item->quantity = 1;
				if($item->save()){
					//update transaction
					$tran->amount = $invoice->invoiceAmount;
					$tran->save();
					return $invoice->id;
				}else{
					$item->flashError();
				}
			}else{
				$invoice->flashError();
			}
		}else{
			$tran->flashError();
		}
				
		
	return false;
	}

}
