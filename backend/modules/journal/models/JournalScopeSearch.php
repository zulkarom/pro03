<?php

namespace backend\modules\journal\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\JournalScope;

/**
 * JournalScopeSearch represents the model behind the search form of `backend\modules\journal\models\JournalScope`.
 */
class JournalScopeSearch extends JournalScope
{
	public $current_journal;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'journal_id', 'scope_id', 'scope_cat'], 'integer'],
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
        $query = JournalScope::find()->where(['journal_id' => $this->current_journal]);
		$query->joinWith(['scope', 'scopeCat'])->orderBy('cat_name ASC, scope_name ASC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
                'pageSize' => 100,
            ],

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
            'journal_id' => $this->journal_id,
            'scope_id' => $this->scope_id,
            'scope_cat' => $this->scope_cat,
        ]);

        return $dataProvider;
    }
}
