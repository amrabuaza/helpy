<?php

namespace common\models\search;

use common\models\Request;
use common\models\user\AdminCategory;
use common\models\user\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `backend\models\Request`.
 */
class RequestSearch extends Request
{
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status'], 'string'],
            [['title', 'description', 'created_at', 'updated_at', 'priority', 'status', 'answered_at', 'category_id'], 'safe'],
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
     * @param $params
     * @param User $currentUser
     * @return ActiveDataProvider
     */
    public function search($params, $currentUser)
    {
        $query = Request::find();
        if ($currentUser->user_type == User::TYPE_ADMIN) {
            $categories = AdminCategory::find()->andWhere(['user_id' => $currentUser->id])->select('category_id')->asArray()->all();
            $categoryIds = [];
            foreach ($categories as $category) {
                $categoryIds[] = $category['category_id'];
            }
            $query->andWhere(['category_id' => $categoryIds]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'priority' => SORT_ASC,
                ]
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
            'priority' => $this->priority,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        if (isset($params['status']) && !is_null($params['status']) && $params['status'] == 'pending') {
            $query->andWhere(['answered_at' => null]);
        }

        return $dataProvider;
    }
}
