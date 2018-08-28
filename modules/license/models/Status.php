<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status สถานะคำขอ
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'สถานะคำขอ',
        ];
    }
}
