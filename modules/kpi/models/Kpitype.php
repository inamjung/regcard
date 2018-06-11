<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "kpitype".
 *
 * @property integer $id
 * @property string $kpitype
 */
class Kpitype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpitype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpitype'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpitype' => 'ลักษณะตัวชี้วัด',
        ];
    }
}
