<?php

namespace backend\modules\journal\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\journal\models\ArticleOverwrite;

/**
 * ArticleOverwriteSearch represents the model behind the search form of `backend\modules\journal\models\ArticleOverwrite`.
 */
class ArticleOverwriteSearch extends ArticleOverwrite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			
			 [['id', 'journal_id', 'yearly_number', 'user_id', 'scope_id', 'pre_evaluate_by', 'invoice_id', 'associate_editor', 'asgn_reviewer_by', 'response_by', 'response_option', 'post_evaluate_by', 'assistant_editor', 'camera_ready_by', 'journal_by', 'journal_issue_id', 'reject_by', 'withdraw_by'], 'integer'],
			 
            [['manuscript_no', 'title', 'keyword', 'abstract', 'reference', 'status', 'submission_file', 'updated_at', 'draft_at', 'submit_at', 'pre_evaluate_at', 'payment_file', 'payment_note', 'review_file', 'pre_evaluate_note', 'asgn_reviewer_at', 'asgn_associate_at', 'review_at', 'review_submit_at', 'response_at', 'response_note', 'correction_at', 'correction_note', 'correction_file', 'post_evaluate_at', 'camera_ready_at', 'camera_ready_note', 'cameraready_file', 'assign_journal_at', 'journal_at', 'reject_at', 'reject_note', 'publish_number', 'doi_ref', 'withdraw_at_status', 'withdraw_at', 'withdraw_note', 'withdraw_request_at'], 'safe'],
			
			
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
        $query = ArticleOverwrite::find();

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
            'journal_id' => $this->journal_id,
            
        ]);

        $query->andFilterWhere(['like', 'manuscript_no', $this->manuscript_no]);
          

        return $dataProvider;
    }
}
