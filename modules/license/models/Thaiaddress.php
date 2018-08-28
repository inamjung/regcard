<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "thaiaddress".
 *
 * @property string $addressid
 * @property string $name
 * @property string $chwpart
 * @property string $amppart
 * @property string $tmbpart
 * @property string $codetype
 * @property string $pocode
 * @property string $full_name
 * @property string $hos_guid
 * @property string $hos_guid_ext
 */
class Thaiaddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thaiaddress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['addressid'], 'required'],
            [['addressid'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 50],
            [['chwpart', 'amppart', 'tmbpart'], 'string', 'max' => 2],
            [['codetype'], 'string', 'max' => 1],
            [['pocode'], 'string', 'max' => 5],
            [['full_name'], 'string', 'max' => 250],
            [['hos_guid'], 'string', 'max' => 38],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['addressid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'addressid' => 'Addressid',
            'name' => 'Name',
            'chwpart' => 'Chwpart',
            'amppart' => 'Amppart',
            'tmbpart' => 'Tmbpart',
            'codetype' => 'Codetype',
            'pocode' => 'Pocode',
            'full_name' => 'Full Name',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
        ];
    }
}
