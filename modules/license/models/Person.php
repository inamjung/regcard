<?php

namespace app\modules\license\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $HOSPCODE
 * @property string $CID
 * @property string $PID
 * @property string $HID
 * @property string $PRENAME
 * @property string $NAME
 * @property string $LNAME
 * @property string $SEX
 * @property string $BIRTH
 * @property string $MSTATUS
 * @property string $OCCUPATION
 * @property string $RACE
 * @property string $NATION
 * @property string $RELIGION
 * @property string $EDUCATION
 * @property string $MOVEIN
 * @property string $DISCHARGE
 * @property string $DDISCHARGE
 * @property string $ABOGROUP
 * @property string $RHGROUP
 * @property string $LABOR
 * @property string $PASSPORT
 * @property string $TYPEAREA
 * @property string $D_UPDATE
 * @property string $public_person_data_chunk_id_temp
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $fullName;
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BIRTH', 'MOVEIN', 'DDISCHARGE', 'D_UPDATE','fullName'], 'safe'],
            [['public_person_data_chunk_id_temp'], 'integer'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['CID'], 'string', 'max' => 13],
            [['PID'], 'string', 'max' => 15],
            [['HID'], 'string', 'max' => 14],
            [['PRENAME', 'RACE', 'NATION'], 'string', 'max' => 3],
            [['NAME', 'LNAME'], 'string', 'max' => 50],
            [['SEX', 'MSTATUS', 'DISCHARGE', 'ABOGROUP', 'RHGROUP', 'TYPEAREA'], 'string', 'max' => 1],
            [['OCCUPATION'], 'string', 'max' => 4],
            [['RELIGION', 'EDUCATION', 'LABOR'], 'string', 'max' => 2],
            [['PASSPORT'], 'string', 'max' => 8],
            [['NATION'],'default','value'=>'099'],
            [['TYPEAREA'],'default','value'=>'1']
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
            'CID' => 'เลขที่บัตรประชาชน',
            'PID' => 'Pid',
            'HID' => 'รหัสหลังคาเรือน',
            'PRENAME' => 'คำนำหน้า',
            'NAME' => 'ชื่อ',
            'LNAME' => 'สกุล',
            'SEX' => 'เพศ',
            'BIRTH' => 'วันที่เกิด',
            'MSTATUS' => 'สถานะ',
            'OCCUPATION' => 'อาชีพ',
            'RACE' => 'Race',
            'NATION' => 'สัญชาติ',
            'RELIGION' => 'Religion',
            'EDUCATION' => 'ระดับการศึกษา',
            'MOVEIN' => 'Movein',
            'DISCHARGE' => 'Discharge',
            'DDISCHARGE' => 'Ddischarge',
            'ABOGROUP' => 'Abogroup',
            'RHGROUP' => 'Rhgroup',
            'LABOR' => 'Labor',
            'PASSPORT' => 'Passport',
            'TYPEAREA' => 'ใน/นอก เขตเทศบาล',
            'D_UPDATE' => 'D  Update',
            'public_person_data_chunk_id_temp' => 'Public Person Data Chunk Id Temp',
            'fullName'=>'ชื่อ-สกุล'
        ];
    }
    public function getFullName(){
        return $this->NAME. ' '.$this->LNAME;
    }
}
