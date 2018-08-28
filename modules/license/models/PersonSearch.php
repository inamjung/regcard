<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\Person;

/**
 * PersonSearch represents the model behind the search form about `app\modules\license\models\Person`.
 */
class PersonSearch extends Person {

    /**
     * @inheritdoc
     */
    public $fullName;

    public function rules() {
        return [
            [['id', 'public_person_data_chunk_id_temp'], 'integer'],
            [['HOSPCODE', 'CID', 'PID', 'HID', 'PRENAME', 'NAME', 'LNAME', 'SEX', 'BIRTH', 'MSTATUS', 'OCCUPATION', 'RACE', 'NATION', 'RELIGION', 'EDUCATION', 'MOVEIN', 'DISCHARGE', 'DDISCHARGE', 'ABOGROUP', 'RHGROUP', 'LABOR', 'PASSPORT', 'TYPEAREA', 'D_UPDATE', 'fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Person::find();

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
            'BIRTH' => $this->BIRTH,
            'MOVEIN' => $this->MOVEIN,
            'DDISCHARGE' => $this->DDISCHARGE,
            'D_UPDATE' => $this->D_UPDATE,
            'public_person_data_chunk_id_temp' => $this->public_person_data_chunk_id_temp,
        ]);

        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
                ->andFilterWhere(['like', 'CID', $this->CID])
                ->andFilterWhere(['like', 'PID', $this->PID])
                ->andFilterWhere(['like', 'HID', $this->HID])
                ->andFilterWhere(['like', 'PRENAME', $this->PRENAME])
                ->andFilterWhere(['like', 'NAME', $this->NAME])
                ->andFilterWhere(['like', 'LNAME', $this->LNAME])
                ->andFilterWhere(['like', 'SEX', $this->SEX])
                ->andFilterWhere(['like', 'MSTATUS', $this->MSTATUS])
                ->andFilterWhere(['like', 'OCCUPATION', $this->OCCUPATION])
                ->andFilterWhere(['like', 'RACE', $this->RACE])
                ->andFilterWhere(['like', 'NATION', $this->NATION])
                ->andFilterWhere(['like', 'RELIGION', $this->RELIGION])
                ->andFilterWhere(['like', 'EDUCATION', $this->EDUCATION])
                ->andFilterWhere(['like', 'DISCHARGE', $this->DISCHARGE])
                ->andFilterWhere(['like', 'ABOGROUP', $this->ABOGROUP])
                ->andFilterWhere(['like', 'RHGROUP', $this->RHGROUP])
                ->andFilterWhere(['like', 'LABOR', $this->LABOR])
                ->andFilterWhere(['like', 'PASSPORT', $this->PASSPORT])
                ->andFilterWhere(['like', 'TYPEAREA', $this->TYPEAREA]);

        $query->andWhere('NAME LIKE "%' . $this->fullName . '%" ' .
                'OR LNAME LIKE "%' . $this->fullName . '%" ' .
                'OR CID LIKE "%' . $this->fullName . '%"');


        return $dataProvider;
    }

}
