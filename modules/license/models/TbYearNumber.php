<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "tb_year_number".
 *
 * @property integer $id
 * @property string $y_year_long
 * @property string $y_year_short
 * @property string $no_number
 */
class TbYearNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_year_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'],'integer'],
            [['status'],'default','value'=>0],
            [['y_year_long'], 'string', 'max' => 4],
            [['y_year_short'], 'string', 'max' => 2],
            [['no_number'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status'=>'ใช้งาน',
            'y_year_long' => 'พศ.แบบยาว',
            'y_year_short' => 'พศ.แบบสั้น',
            'no_number' => 'เลขที่เริ่มต้น',
        ];
    }
}
