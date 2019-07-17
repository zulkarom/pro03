<?php

namespace ijeob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\Article;

/**
 * SearchArticle represents the model behind the search form of `backend\modules\journal\models\Article`.
 */
class AdvancedSearchArticle extends Article
{
	public $author;
	public $year_from;
	public $year_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			
			[['title', 'keyword', 'abstract', 'author', 'scope_id', 'doi_ref'], 'string'],
			
			[['scope_id', 'year_from', 'year_to'], 'integer'],
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
	
        $query = Article::find()->where(['jeb_article.status' => 'ArticleWorkflow/qa-publish']);
		$query->joinWith(['articleAuthors', 'journalIssue']);

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
		

		
		if(!isset(Yii::$app->request->queryParams['AdvancedSearchArticle'])){
            $query->where('0=1');
            return $dataProvider;
        }else{
			$params = Yii::$app->request->queryParams['AdvancedSearchArticle'];
			$no_value = true;
			foreach($params as $p){
				if($p){
					$no_value = false;
					break;
				}
			}
			if($no_value){
				$query->where('0=1');
				return $dataProvider;
			}
		}
		
		


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
			->andFilterWhere(['like', 'doi_ref', $this->doi_ref])
			->andFilterWhere(['like', 'scope_id', $this->scope_id]);
			
		if($this->year_from){
			$query->andWhere(['>=', 'jeb_journal_issue.issue_year', $this->year_from]);
		}
		 
		 
		 if($this->year_to){
			 $query->andWhere(['<=', 'jeb_journal_issue.issue_year', $this->year_to]);
		 }
		
			
		$query->andFilterWhere(['like', 'jeb_article_author.firstname', $this->author]) ->orFilterWhere(['like', 'jeb_article_author.lastname', $this->author])
            ;


        return $dataProvider;
    }
}
