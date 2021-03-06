<?php

namespace ijeob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\account\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form of `backend\modules\account\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'status', 'quotation_id', 'created_by', 'trash'], 'integer'],
            [['summary', 'invoice_date', 'due_date', 'note', 'created_at', 'updated_at', 'token'], 'safe'],
            [['discount', 'gst'], 'number'],
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
        $query = Invoice::find();

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
            'client_id' => Yii::$app->user->identity->id,
        ]);

        $query->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
