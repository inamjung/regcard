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
    public $deps;
   // public $countdeps;
    public function rules()
    {
        return [
            [['id','period_id', 'kpidepart_id', 'statuskpi', 'user_result_id', 'user_edit_result_id','level_id_1','level_id_2','level_id_3'], 'integer'],
            [[ 'level_id','kpi_h_id', 'kpiname', 'kpiyear', 'd_begin_year', 'goal_des', 'denom_c_unit', 'devide_c_unit', 'target_des', 'critiria_value', 'user_kpi', 'd_add', 'update_d', 'operation', 'formula', 'docs', 'ref','deps'], 'safe'],
            [['goal', 'denom', 'denom_c', 'devide', 'devide_c', 'target'], 'number'],
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
            'period_id' => $this->period_id,
            'd_begin_year' => $this->d_begin_year,
            'goal' => $this->goal,
            'denom' => $this->denom,
            'denom_c' => $this->denom_c,
            'devide' => $this->devide,
            'devide_c' => $this->devide_c,
            'target' => $this->target,
            'kpidepart_id' => $this->kpidepart_id,
            'statuskpi' => $this->statuskpi,
            'user_result_id' => $this->user_result_id,
            'd_add' => $this->d_add,
            'user_edit_result_id' => $this->user_edit_result_id,
            'update_d' => $this->update_d,
            //'level_id_1' => $this->level_id_1,
            //'level_id_2' => $this->level_id_2,
            //'level_id_3' => $this->level_id_3,
            
        ]);

        $query->andFilterWhere(['like', 'kpiname', $this->kpiname])
            ->andFilterWhere(['like', 'kpiyear', $this->kpiyear])
            ->andFilterWhere(['like', 'goal_des', $this->goal_des])
            ->andFilterWhere(['like', 'denom_c_unit', $this->denom_c_unit])
            ->andFilterWhere(['like', 'devide_c_unit', $this->devide_c_unit])
            ->andFilterWhere(['like', 'target_des', $this->target_des])
            ->andFilterWhere(['like', 'critiria_value', $this->critiria_value])
            ->andFilterWhere(['like', 'user_kpi', $this->user_kpi])
            ->andFilterWhere(['like', 'operation', $this->operation])
            ->andFilterWhere(['like', 'formula', $this->formula])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'kpi_h_id',  $this->kpi_h_id])
            ->andFilterWhere(['like', 'level_id',  $this->level_id])
            ->andFilterWhere(['=', 'level_id_1',  $this->level_id_1])
            ->andFilterWhere(['=', 'level_id_2',  $this->level_id_2])
            ->andFilterWhere(['=', 'level_id_3',  $this->level_id_3])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
