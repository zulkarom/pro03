<?php

namespace ijeob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\account\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `backend\modules\account\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'debit', 'credit', 'medium', 'assoc_staff', 'assoc_client', 'assoc_tran', 'created_by', 'trash', 'trashed_by'], 'integer'],
			
			
            [['tran_date', 'reference', 'description', 'created_at', 'modified_at', 'trashed_at'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transaction::find()->where(['assoc_client' => Yii::$app->user->identity->id])->orderBy('created_at DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tran_date' => $this->tran_date,

        ]);


        return $dataProvider;
    }
}
