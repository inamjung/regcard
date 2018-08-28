<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "regconfig".
 *
 * @property integer $id
 * @property string $addressid
 * @property string $addr_text
 * @property string $tel
 */
class Regconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $logo_img;
    public static function tableName()
    {
        return 'regconfig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addressid'],'required'],
            [['addressid'], 'string', 'max' => 6],
            [['addr_text','book_no','logo'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 50],
            [['plogo_img'], 'file', 'skipOnEmpty'=>'true','on'=>'update','extensions'=>'jpg,png,gif,JPG'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'addressid' => 'เทศบาลอำเภอ',
            'addr_text' => 'เลขที่ตั้ง',
            'tel' => 'โทรศัฑท์',
            'book_no'=>'เลขที่หนังสือ',
            'logo'=>'Logo',
            'logo_img'=>'Logo'
        ];
    }
}
