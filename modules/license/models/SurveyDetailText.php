<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "survey_detail_text".
 *
 * @property integer $id
 * @property integer $store_at_id
 * @property string $name
 */
class SurveyDetailText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_detail_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'],'required'],
            [['store_at_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'เงื่อนไขการอนุญาต',
        ];
    }
}
