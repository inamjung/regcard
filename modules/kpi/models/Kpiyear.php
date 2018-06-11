<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "kpiyear".
 *
 * @property string $kpiyear
 * @property string $d_begin
 * @property string $d_end
 * @property string $range
 */
class Kpiyear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpiyear';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpiyear'], 'required'],
            [['d_begin', 'd_end'], 'safe'],
            [['kpiyear'], 'string', 'max' => 4],
            [['range'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kpiyear' => 'ปี kpi',
            'd_begin' => 'เริ่มปีงบ',
            'd_end' => 'สิ้นปีงบ',
            'range' => 'ช่วงเวลา',
        ];
    }
}
