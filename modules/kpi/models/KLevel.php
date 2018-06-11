<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "k_level".
 *
 * @property integer $id
 * @property string $kpi_pon_level
 */
class KLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_pon_level'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_pon_level' => 'ระดับการแสดงผล',
        ];
    }
}
