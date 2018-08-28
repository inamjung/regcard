<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "receive_detail_evidence_not".
 *
 * @property integer $id
 * @property integer $receive_id
 * @property integer $evidence_id
 */
class ReceiveDetailEvidenceNot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receive_detail_evidence_not';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receive_id', 'evidence_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'สถาพสถานที่',
            'receive_id' => 'Receive ID',
            'evidence_id' => 'เอกสาร/หลักฐานที่ไม่ครบ',
        ];
    }
    public function getEvidencenamenot(){
        return $this->hasOne(Evidence::className(), ['id'=>'evidence_id']);
    }
}
