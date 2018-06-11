<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "k_kong".
 *
 * @property integer $id
 * @property string $kpi_kong
 */
class KKong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_kong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_kong'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_kong' => 'โครงการ',
        ];
    }
}
