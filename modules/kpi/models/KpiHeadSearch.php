<?php

namespace app\modules\kpi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kpi\models\KpiHead;

/**
 * KpiHeadSearch represents the model behind the search form about `app\modules\kpi\models\KpiHead`.
 */
class KpiHeadSearch extends KpiHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mond_id', 'pan_id', 'kong_id',  'kpitype_id', 'kpidepart_id', 'statuskpi', 'user_id'], 'integer'],
            [['level_id','name_h', 'kpidesc', 'perfomance', 'target', 'fomula', 'source', 'kpiyear', 'user_kpi_h', 'docs', 'ref', 'create_d', 'upadte_d'], 'safe'],
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
        $query = KpiHead::find();

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
            'mond_id' => $this->mond_id,
            'pan_id' => $this->pan_id,
            'kong_id' => $this->kong_id,
            //'level_id' => $this->level_id,
            'kpitype_id' => $this->kpitype_id,
            'kpidepart_id' => $this->kpidepart_id,
            'statuskpi' => $this->statuskpi,
            'user_id' => $this->user_id,
            'create_d' => $this->create_d,
            'upadte_d' => $this->upadte_d,
        ]);

        $query->andFilterWhere(['like', 'name_h', $this->name_h])
            ->andFilterWhere(['like', 'kpidesc', $this->kpidesc])
            ->andFilterWhere(['like', 'perfomance', $this->perfomance])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'fomula', $this->fomula])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'kpiyear', $this->kpiyear])
            ->andFilterWhere(['like', 'user_kpi_h', $this->user_kpi_h])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'level_id', $this->level_id])    
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
