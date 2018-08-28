<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\SurveyDetailText;

/**
 * SurveyDetailTextSearch represents the model behind the search form about `app\modules\license\models\SurveyDetailText`.
 */
class SurveyDetailTextSearch extends SurveyDetailText
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_at_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = SurveyDetailText::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'store_at_id' => $this->store_at_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
