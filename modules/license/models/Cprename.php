<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "c_prename".
 *
 * @property string $id
 * @property string $title_th
 * @property string $detail
 * @property string $title_en
 */
class Cprename extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_prename';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title_th'], 'required'],
            [['id'], 'string', 'max' => 3],
            [['title_th', 'detail', 'title_en'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_th' => 'Title Th',
            'detail' => 'Detail',
            'title_en' => 'Title En',
        ];
    }
}
