<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "home".
 *
 * @property integer $id
 * @property string $HOSPCODE
 * @property string $HID
 * @property string $HOUSE_ID
 * @property string $ROOMNO
 * @property string $HOUSE
 * @property string $SOISUB
 * @property string $SOIMAIN
 * @property string $ROAD
 * @property string $VILLANAME
 * @property string $VILLAGE
 * @property string $TAMBON
 * @property string $AMPUR
 * @property string $CHANGWAT
 * @property string $TELEPHONE
 * @property string $LATITUDE
 * @property string $LONGITUDE
 * @property string $OUTDATE
 * @property string $D_UPDATE
 * @property string $public_home_data_chunk_id_temp
 * @property string $TYPEAREA
 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VILLAGE', 'TAMBON', 'AMPUR', 'CHANGWAT'],'required'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
            [['OUTDATE', 'D_UPDATE'], 'safe'],
            [['public_home_data_chunk_id_temp'], 'integer'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['HID'], 'string', 'max' => 14],
            [['HOUSE_ID'], 'string', 'max' => 11],
            [['ROOMNO'], 'string', 'max' => 10],
            [['HOUSE'], 'string', 'max' => 75],
            [['SOISUB', 'SOIMAIN', 'ROAD', 'VILLANAME'], 'string', 'max' => 255],
            [['VILLAGE', 'TAMBON', 'AMPUR', 'CHANGWAT'], 'string', 'max' => 4],
            [['TELEPHONE'], 'string', 'max' => 15],
            [['TYPEAREA'], 'string', 'max' => '1'],
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
            'HID' => 'Hid',
            'HOUSE_ID' => 'House  ID',
            'ROOMNO' => 'Roomno',
            'HOUSE' => 'เลขที่บ้าน',
            'SOISUB' => 'Soisub',
            'SOIMAIN' => 'Soimain',
            'ROAD' => 'Road',
            'VILLANAME' => 'Villaname',
            'VILLAGE' => 'หมู่บ้าน',
            'TAMBON' => 'ตำบล',
            'AMPUR' => 'อำเภอ',
            'CHANGWAT' => 'จังหวัด',
            'TELEPHONE' => 'โทรศัพท์',
            'LATITUDE' => 'Latitude',
            'LONGITUDE' => 'Longitude',
            'OUTDATE' => 'Outdate',
            'D_UPDATE' => 'D  Update',
            'public_home_data_chunk_id_temp' => 'Public Home Data Chunk Id Temp',
            'TYPEAREA' => 'ใน/นอก เขตเทศบาล',
        ];
    }
    public function getVillageno(){
        return $this->hasOne(Village::className(), ['id'=>'VILLAGE']);
    }

    public function getTypeareaname(){
        return $this->villageno->TYPEAREA;
    }
}
