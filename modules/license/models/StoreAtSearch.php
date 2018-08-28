<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\StoreAt;

/**
 * StoreAtSearch represents the model behind the search form about `app\modules\license\models\StoreAt`.
 */
class StoreAtSearch extends StoreAt
{
 
    public $storetypeat;
    public function rules()
    {
        return [
            [['id', 'receive_id', 'user_id', 'status','store_type_id'], 'integer'],
            [['store_area'], 'number'],
            [['code_no', 'store_name', 'store_type', 'store_addr', 'store_moo', 'store_tmb'
                , 'store_amp', 'store_chw', 'store_phone', 'date_request', 'evidence', 'evidence_other'
                , 'store_own_cid', 'store_own_pname', 'store_own_fname', 'store_own_lname', 'store_own_dob'
                , 'store_own_age', 'store_own_sex', 'store_own_nation', 'place_request', 'date_key'
                , 'incontrol', 'lat', 'lng', 'survey_type', 'survey_text', 'date_survey', 'user_survey'
                ,'store_person', 'store_own_addr','store_own_moo','store_own_tmb','store_own_amp'
                ,'store_own_chw','store_area_type','storetypeat'], 'safe'],
           
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
        $query = StoreAt::find();

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
            'receive_id' => $this->receive_id,
            'store_area' => $this->store_area,
            'date_request' => $this->date_request,
            'store_own_dob' => $this->store_own_dob,
            'user_id' => $this->user_id,
            'date_key' => $this->date_key,
            'date_survey' => $this->date_survey,
            'status' => $this->status,
            'store_type_id'=> $this->store_type_id,
        ]);

        $query->andFilterWhere(['like', 'code_no', $this->code_no])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_type', $this->store_type])
            ->andFilterWhere(['like', 'store_addr', $this->store_addr])
            ->andFilterWhere(['like', 'store_moo', $this->store_moo])
            ->andFilterWhere(['like', 'store_tmb', $this->store_tmb])
            ->andFilterWhere(['like', 'store_amp', $this->store_amp])
            ->andFilterWhere(['like', 'store_chw', $this->store_chw])
            ->andFilterWhere(['like', 'store_phone', $this->store_phone])
            ->andFilterWhere(['like', 'evidence', $this->evidence])
            ->andFilterWhere(['like', 'evidence_other', $this->evidence_other])
            ->andFilterWhere(['like', 'store_own_cid', $this->store_own_cid])
            ->andFilterWhere(['like', 'store_own_pname', $this->store_own_pname])
            ->andFilterWhere(['like', 'store_own_fname', $this->store_own_fname])
            ->andFilterWhere(['like', 'store_own_lname', $this->store_own_lname])
            ->andFilterWhere(['like', 'store_own_age', $this->store_own_age])
            ->andFilterWhere(['like', 'store_own_sex', $this->store_own_sex])
            ->andFilterWhere(['like', 'store_own_nation', $this->store_own_nation])
            ->andFilterWhere(['like', 'place_request', $this->place_request])
            ->andFilterWhere(['like', 'incontrol', $this->incontrol])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'survey_type', $this->survey_type])
            ->andFilterWhere(['like', 'survey_text', $this->survey_text])
            ->andFilterWhere(['like', 'store_person', $this->store_person])                 
            ->andFilterWhere(['like', 'store_own_addr', $this->store_own_addr]) 
            ->andFilterWhere(['like', 'store_own_moo', $this->store_own_moo])    
            ->andFilterWhere(['like', 'store_own_tmb', $this->store_own_tmb])      
            ->andFilterWhere(['like', 'store_own_amp', $this->store_own_amp])
            ->andFilterWhere(['like', 'store_own_chw', $this->store_own_chw])
            ->andFilterWhere(['like', 'store_area_type', $this->store_area_type])    
            ->andFilterWhere(['like', 'user_survey', $this->user_survey]);

        return $dataProvider;
    }
}
