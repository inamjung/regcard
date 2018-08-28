<?php

namespace app\modules\license\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\license\models\ReceiveDetailEvidence;

/**
 * ReceiveDetailEvidenceSearch represents the model behind the search form about `app\modules\license\models\ReceiveDetailEvidence`.
 */
class ReceiveDetailEvidenceSearch extends ReceiveDetailEvidence
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'receive_id', 'evidence_id'], 'integer'],
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
        $query = ReceiveDetailEvidence::find();

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
            'evidence_id' => $this->evidence_id,
        ]);

        return $dataProvider;
    }
}
