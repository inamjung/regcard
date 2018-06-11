<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "kpiperiod".
 *
 * @property integer $id
 * @property integer $period
 * @property integer $d_total
 * @property string $description
 */
class Kpiperiod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpiperiod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period', 'd_total'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period' => 'จำนวนครั้งการประมวลผล/ปี',
            'd_total' => 'จำนวนวันของงวด(ทุกกี่วัน)',
            'description' => 'คำอธิบาย',
        ];
    }
}
