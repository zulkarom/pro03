<?php

namespace backend\modules\journal\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\Journal;

/**
 * JournalSearch represents the model behind the search form of `backend\modules\journal\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['journal_name', 'journal_abbr', 'journal_url', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Journal::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'journal_name', $this->journal_name])
            ->andFilterWhere(['like', 'journal_abbr', $this->journal_abbr])
            ->andFilterWhere(['like', 'journal_url', $this->journal_url]);

        return $dataProvider;
    }
}
