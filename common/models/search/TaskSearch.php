<?php

namespace common\models\search;

use common\models\Project;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;
use common\models\query\UserQuery;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    public $project;
    public $executor;
//    public $creator;
//    public $updater;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'executor_id', 'started_at', 'completed_at', 'creator_id', 'updater_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'project'], 'safe'],
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
        $query = Task::find();
        $query->joinWith(['project']);
        $query->joinWith(['executor']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'project' => [
                    'asc' => ['title' => SORT_ASC],
                    'desc' => ['title' => SORT_DESC],
                ],
                'executor' => [
                    'asc' => ['username' => SORT_ASC],
                    'desc' => ['username' => SORT_DESC],
                ],
            ]
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
            'project_id' => $this->project_id,
            'executor_id' => $this->executor_id,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'creator_id' => $this->creator_id,
            'updater_id' => $this->updater_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', Project::tableName().'.title', $this->project]);
//            ->andFilterWhere(['like', User::tableName().'.username', $this->executor]);


        return $dataProvider;
    }
}
