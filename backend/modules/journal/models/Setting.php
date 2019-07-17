<?php

namespace backend\modules\journal\models;

use Yii;

/**
 * This is the model class for table "jeb_setting".
 *
 * @property int $id
 * @property string $template_file
 * @property string $template2_file
 * @property string $pay_amount
 * @property string $updated_at
 * @property string $pay_review
 * @property string $admin_url
 */
class Setting extends \yii\db\ActiveRecord
{
	public $template_instance;
	
	public $template2_instance;
	
	//this for local
	public static $frontUrl = './../../frontend/web/';
	
	//ensure to use this on production
	//public static $frontUrl = '../';
	
	public $file_controller;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jeb_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['template_file'], 'required'],
			
			[['pay_amount', 'pay_review'], 'number'],
			
            [['template_file'], 'string', 'max' => 100],
			
			[['admin_url', 'bank_name', 'account_no', 'account_name'], 'string', 'max' => 200],
			
			[['template_file'], 'required', 'on' => 'template_upload'],
			
			[['template2_file'], 'required', 'on' => 'template2_upload'],
			
			
			
            [['template_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf', 'maxSize' => 5000000],
            [['updated_at'], 'required', 'on' => 'template_delete'],
			
			[['template2_instance'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf', 'maxSize' => 5000000],
            [['updated_at'], 'required', 'on' => 'template2_delete'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_file' => 'Template File (EN)',
			'template2_file' => 'Template File (BM)',
			'account_name' => 'Account Name',
			'account_no' => 'Account Number',
			'bank_name' => 'Bank Name',
        ];
    }
	
	public static function getOne(){
		return self::findOne(1);
	}
}
