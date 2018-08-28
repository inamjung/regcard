<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "survey_type".
 *
 * @property integer $id
 * @property string $name
 */
class SurveyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ข้อกำหนดการสำรวจ',
        ];
    }
}
