<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "village".
 *
 * @property string $id
 * @property string $HOSPCODE
 * @property string $VID
 * @property string $NAME
 * @property string $TYPEAREA
 * @property string $D_UPDATE
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['D_UPDATE'], 'safe'],
            [['id'], 'string', 'max' => 2],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['VID'], 'string', 'max' => 8],
            [['NAME'], 'string', 'max' => 255],
            [['TYPEAREA'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'HOSPCODE' => 'Hospcode',
            'VID' => 'Vid',
            'NAME' => 'Name',
            'TYPEAREA' => 'Typearea',
            'D_UPDATE' => 'D  Update',
        ];
    }
}
