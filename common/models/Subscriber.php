<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscriber".
 *
 * @property int $id
 * @property string $subs_email
 * @property string $created_at
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriber';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subs_email', 'created_at'], 'required'],
            [['created_at'], 'safe'],
			[['subs_email'], 'email'],
            [['subs_email'], 'string', 'max' => 200],
			
			['subs_email', 'unique', 'targetClass' => '\common\models\Subscriber', 'message' => 'Thank you, your email has already been subscribed.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subs_email' => 'Your Email',
            'created_at' => 'Created At',
        ];
    }
}
