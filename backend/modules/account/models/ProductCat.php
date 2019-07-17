<?php

namespace backend\modules\account\models;

use Yii;

/**
 * This is the model class for table "acc_product_cat".
 *
 * @property int $id
 * @property string $category_name
 * @property string $unit_measure
 * @property string $price_perunit
 * @property int $status 1=active, 0= not active
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $trash
 */
class ProductCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acc_product_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'unit_measure', 'price_perunit', 'created_by', 'created_at', 'updated_at', 'trash'], 'required'],
            [['price_perunit'], 'number'],
            [['status', 'created_by', 'trash'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_name'], 'string', 'max' => 200],
            [['unit_measure'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'unit_measure' => 'Unit Measure',
            'price_perunit' => 'Price Perunit',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'trash' => 'Trash',
        ];
    }
}
