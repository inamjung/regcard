<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "k_pan".
 *
 * @property integer $id
 * @property string $kpi_pan
 */
class KPan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_pan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_pan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_pan' => 'แผน',
        ];
    }
}
