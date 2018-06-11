<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "kpidepart".
 *
 * @property integer $id
 * @property string $kpi_dep
 */
class Kpidepart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpidepart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_dep'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_dep' => 'งานที่รับผิดชอบ',
        ];
    }
}
