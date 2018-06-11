<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property integer $id
 * @property string $name
 * @property integer $group_id
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'หน่วยงาน',
            'group_id' => 'กลุ่มงาน',
        ];
    }
}
