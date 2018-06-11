<?php

namespace app\modules\kpi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kpi\models\Kpidata;

/**
 * KpidataSearch represents the model behind the search form about `app\modules\kpi\models\Kpidata`.
 */
class KpidataSearch extends Kpidata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kpi_id', 'frequency_no', 'user_id_result', 'qty_kan', 'kan', 'kpilist_id' ,'period_id'], 'integer'],
            [['d_end_result', 'result_text', 'd_add', 'd_edit', 'docs', 'target_des', 'ref','operation','t'], 'safe'],
            [['denom', 'devide', 'devide_c', 'denom_c', 'result', 'calc', 'goal', 'target'], 'number'],
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
        $query = Kpidata::find();

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
            'kpi_id' => $this->kpi_id,
            'frequency_no' => $this->frequency_no,
            'd_end_result' => $this->d_end_result,
            'denom' => $this->denom,
            'devide' => $this->devide,
            'devide_c' => $this->devide_c,
            'denom_c' => $this->denom_c,
            'result' => $this->result,
            'calc' => $this->calc,
            'user_id_result' => $this->user_id_result,
            'd_add' => $this->d_add,
            'd_edit' => $this->d_edit,
            'goal' => $this->goal,
            'target' => $this->target,
            'qty_kan' => $this->qty_kan,
            'kan' => $this->kan,
            'period_id' => $this->period_id,
            'kpilist_id' => $this->kpilist_id,
        ]);

        $query->andFilterWhere(['like', 'result_text', $this->result_text])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'target_des', $this->target_des])
            ->andFilterWhere(['like', 'operation', $this->operation])
                ->andFilterWhere(['like', 't', $this->t])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
