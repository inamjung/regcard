<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "occupations".
 *
 * @property integer $id
 * @property string $name
 */
class Occupations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'occupations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ระดับ',
        ];
    }
}
