<?php

namespace app\modules\kpi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kpi\models\Kpiyear;

/**
 * KpiyearSearch represents the model behind the search form about `app\modules\kpi\models\Kpiyear`.
 */
class KpiyearSearch extends Kpiyear
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpiyear', 'd_begin', 'd_end', 'range'], 'safe'],
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
        $query = Kpiyear::find();

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
            'd_begin' => $this->d_begin,
            'd_end' => $this->d_end,
        ]);

        $query->andFilterWhere(['like', 'kpiyear', $this->kpiyear])
            ->andFilterWhere(['like', 'range', $this->range]);

        return $dataProvider;
    }
}
