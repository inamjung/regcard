<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\Home;

/**
 * HomeSearch represents the model behind the search form about `app\modules\license\models\Home`.
 */
class HomeSearch extends Home
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'public_home_data_chunk_id_temp'], 'integer'],
            [['HOSPCODE', 'HID', 'HOUSE_ID', 'ROOMNO', 'HOUSE', 'SOISUB', 'SOIMAIN', 'ROAD', 'VILLANAME', 'VILLAGE', 'TAMBON', 'AMPUR', 'CHANGWAT', 'TELEPHONE', 'OUTDATE', 'D_UPDATE', 'TYPEAREA'], 'safe'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
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
        $query = Home::find();

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
            'LATITUDE' => $this->LATITUDE,
            'LONGITUDE' => $this->LONGITUDE,
            'OUTDATE' => $this->OUTDATE,
            'D_UPDATE' => $this->D_UPDATE,
            'public_home_data_chunk_id_temp' => $this->public_home_data_chunk_id_temp,
        ]);

        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'HID', $this->HID])
            ->andFilterWhere(['like', 'HOUSE_ID', $this->HOUSE_ID])
            ->andFilterWhere(['like', 'ROOMNO', $this->ROOMNO])
            ->andFilterWhere(['like', 'HOUSE', $this->HOUSE])
            ->andFilterWhere(['like', 'SOISUB', $this->SOISUB])
            ->andFilterWhere(['like', 'SOIMAIN', $this->SOIMAIN])
            ->andFilterWhere(['like', 'ROAD', $this->ROAD])
            ->andFilterWhere(['like', 'VILLANAME', $this->VILLANAME])
            ->andFilterWhere(['like', 'VILLAGE', $this->VILLAGE])
            ->andFilterWhere(['like', 'TAMBON', $this->TAMBON])
            ->andFilterWhere(['like', 'AMPUR', $this->AMPUR])
            ->andFilterWhere(['like', 'CHANGWAT', $this->CHANGWAT])
            ->andFilterWhere(['like', 'TELEPHONE', $this->TELEPHONE])
            ->andFilterWhere(['like', 'TYPEAREA', $this->TYPEAREA]);

        return $dataProvider;
    }
}
