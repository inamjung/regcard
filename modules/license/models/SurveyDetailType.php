<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "survey_detail_type".
 *
 * @property integer $id
 * @property integer $store_at_id
 * @property integer $type_id
 */
class SurveyDetailType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_detail_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'],'required'],
            [['store_at_id', 'type_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'สถาพสถานที่',
            'store_at_id' => 'Store At ID',
            'type_id' => 'ข้อกำหนดที่ไม่ครบ',
        ];
    }
    public function getTypename(){
        return $this->hasOne(SurveyType::className(), ['id'=>'type_id']);
    }
}
