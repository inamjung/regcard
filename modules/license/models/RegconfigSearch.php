<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\Regconfig;

/**
 * RegconfigSearch represents the model behind the search form about `app\modules\license\models\Regconfig`.
 */
class RegconfigSearch extends Regconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['addressid', 'addr_text', 'tel','book_no','logo'], 'safe'],
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

 
    public function search($params)
    {
        $query = Regconfig::find();

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
        ]);

        $query->andFilterWhere(['like', 'addressid', $this->addressid])
            ->andFilterWhere(['like', 'addr_text', $this->addr_text])
            ->andFilterWhere(['like', 'book_no', $this->book_no])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}
