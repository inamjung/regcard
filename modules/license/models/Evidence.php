<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "evidence".
 *
 * @property int $id
 * @property string $evidence หลักฐาน
 */
class Evidence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evidence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evidence'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'evidence' => 'หลักฐาน',
        ];
    }
}
