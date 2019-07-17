<?php

namespace backend\modules\journal\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Todo;

/**
 * SubmissionSearch represents the model behind the search form of `common\models\Article`.
 */
class SubmissionSearch extends Article
{
	public $str_search;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
		
		
        return [
		
            [['str_search'], 'string'],
			
            [['str_search'], 'safe'],
			
			
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
        $query = Article::find();
		$query->joinWith(['journal']);

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
		
		
		
		//authors
		$query->orFilterWhere([
			'jeb_article.status' => 'ArticleWorkflow/ba-pre-evaluate'
        ]);
		
		$dataProvider->sort->attributes['journal.journal_abbr'] = [
        'asc' => ['journal.journal_abbr' => SORT_ASC],
        'desc' => ['journal.journal_abbr' => SORT_DESC],
        ]; 

		

        return $dataProvider;
    }
}
