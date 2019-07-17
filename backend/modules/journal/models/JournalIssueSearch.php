<?php

namespace backend\modules\journal\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\JournalIssue;

/**
 * JournalSearch represents the model behind the search form of `backend\modules\journal\models\Journal`.
 */
class JournalIssueSearch extends JournalIssue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['volume', 'issue', 'status', 'journal_id'], 'integer'],
			
            [['issue_month'], 'string'],
			
			[['issue_year'], 'safe'],
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
        $query = JournalIssue::find()->orderBy('status ASC, volume DESC, issue DESC');
		
		$query->joinWith('journal');

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
            'volume' => $this->volume,
            'issue' => $this->issue,
            'status' => $this->status,
            'issue_year' => $this->issue_year,
			'journal_id' => $this->journal_id,
			'issue_month' => $this->issue_month,
        ]);
		
		$dataProvider->sort->attributes['journal.journal_abbr'] = [
        'asc' => ['journal.journal_abbr' => SORT_ASC],
        'desc' => ['journal.journal_abbr' => SORT_DESC],
        ]; 



        return $dataProvider;
    }
}
