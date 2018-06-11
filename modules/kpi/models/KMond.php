<?php

namespace app\modules\kpi\models;

use Yii;

/**
 * This is the model class for table "k_mond".
 *
 * @property integer $id
 * @property string $kpi_mond
 */
class KMond extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_mond';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_mond'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_mond' => 'หมวด',
        ];
    }
}
