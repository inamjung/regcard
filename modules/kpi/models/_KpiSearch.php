<?php

namespace app\modules\kpi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kpi\models\Kpi;

/**
 * KpiSearch represents the model behind the search form about `app\modules\kpi\models\Kpi`.
 */
class KpiSearch extends Kpi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kpitype_id', 'period_id', 'kpidepart_id', 'statuskpi', 'useradd_id', 'useredit_id'], 'integer'],
            [['kpiname', 'kpidesc', 'kpiyear', 'd_begin_year', 'goal_des', 'target_des', 'denom_c_unit', 'devide_c_unit', 'critiria_value', 'sourcekpi', 'user_kpi', 'd_add', 'd_edit', 'operation', 'formula', 'docs', 'ref'], 'safe'],
            [['goal', 'denom', 'devide', 'target', 'denom_c', 'devide_c'], 'number'],
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
        $query = Kpi::find();

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
            'kpitype_id' => $this->kpitype_id,
            'period_id' => $this->period_id,
            'd_begin_year' => $this->d_begin_year,
            'goal' => $this->goal,
            'denom' => $this->denom,
            'devide' => $this->devide,
            'target' => $this->target,
            'denom_c' => $this->denom_c,
            'devide_c' => $this->devide_c,
            'kpidepart_id' => $this->kpidepart_id,
            'statuskpi' => $this->statuskpi,
            'useradd_id' => $this->useradd_id,
            'd_add' => $this->d_add,
            'useredit_id' => $this->useredit_id,
            'd_edit' => $this->d_edit,
        ]);

        $query->andFilterWhere(['like', 'kpiname', $this->kpiname])
            ->andFilterWhere(['like', 'kpidesc', $this->kpidesc])
            ->andFilterWhere(['like', 'kpiyear', $this->kpiyear])
            ->andFilterWhere(['like', 'goal_des', $this->goal_des])
            ->andFilterWhere(['like', 'target_des', $this->target_des])
            ->andFilterWhere(['like', 'denom_c_unit', $this->denom_c_unit])
            ->andFilterWhere(['like', 'devide_c_unit', $this->devide_c_unit])
            ->andFilterWhere(['like', 'critiria_value', $this->critiria_value])
            ->andFilterWhere(['like', 'sourcekpi', $this->sourcekpi])
            ->andFilterWhere(['like', 'user_kpi', $this->user_kpi])
            ->andFilterWhere(['like', 'operation', $this->operation])
            ->andFilterWhere(['like', 'formula', $this->formula])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
