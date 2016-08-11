<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'session_id', 'user_id'], 'integer'],
            [['question'], 'safe'],
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
        $query = Question::find();

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
            'session_id' => $this->session_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question]);

        return $dataProvider;
    }
}
