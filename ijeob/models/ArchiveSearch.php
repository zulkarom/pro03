<?php

namespace ijeob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\JournalIssue;

/**
 * ArchiveSearch represents the model behind the search form of `backend\modules\journal\models\Journal`.
 */
class ArchiveSearch extends JournalIssue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'volume', 'issue', 'status', 'is_special'], 'integer'],
            [['issue_name', 'description', 'published_at', 'archived_at'], 'safe'],
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
        $query = JournalIssue::find()->orderBy('volume DESC, issue DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			//'sort'=> ['defaultOrder' => ['status'=>SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status' => 30,
        ]);

        $query->andFilterWhere(['like', 'issue_name', $this->issue_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
