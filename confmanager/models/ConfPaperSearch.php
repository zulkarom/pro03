<?php

namespace confmanager\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\conference\models\ConfPaper;

/**
 * ConfPaperSearch represents the model behind the search form of `backend\modules\conference\models\ConfPaper`.
 */
class ConfPaperSearch extends ConfPaper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'conf_id', 'user_id'], 'integer'],
            [['pap_title', 'pap_abstract', 'paper_file', 'created_at', 'updated_at'], 'safe'],
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
        $query = ConfPaper::find()->where(['conf_id' => $this->conf_id]);

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
            'conf_id' => $this->conf_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pap_title', $this->pap_title])
            ->andFilterWhere(['like', 'pap_abstract', $this->pap_abstract])
            ->andFilterWhere(['like', 'paper_file', $this->paper_file]);

        return $dataProvider;
    }
}
