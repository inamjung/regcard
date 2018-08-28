<?php

namespace app\modules\license\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\license\models\Evidence;
/**
 * This is the model class for table "receive".
 *
 * @property int $id
 * @property int $code_no รหัสรับเรื่อง
 * @property string $store_name ชื่อสถานประกอบการ
 * @property string $store_type ประเภท
 * @property string $store_addr เลขที่ตั้ง
 * @property string $store_moo หมู่ที่
 * @property string $store_tmb ตำบล
 * @property string $store_amp อำเภอ
 * @property string $store_chw จังหวัด
 * @property string $store_phone หมายเลขโทรศัพท์
 * @property string $date_request วันที่รับเรื่อง
 * @property string $evidence หลักฐาน
 * @property string $evidence_other หลักฐานที่ยังไม่ครบ
 * @property string $store_own_name เจ้าของกิจการ
 * @property string $store_own_age อายุ
 * @property string $store_own_nation สัญชาติ
 * @property int $user_id เจ้าหน้าที่
 * @property string $date_key วันที่บันทึก
 * @property int $status สถานะคำขอ
 */
class Receive extends \yii\db\ActiveRecord
{
 
    public $storetypes;
    public static function tableName()
    {
        return 'receive';
    }

 
    public function rules()
    {
        return [
            [['user_id', 'status','store_type_id'], 'integer'],
            [['store_area'],'number'],
            [['code_no','store_type','date_request','store_name'], 'required'],
            [['date_request', 'date_key','store_own_dob', 'evidence', 'evidence_other','storetypes'], 'safe'],
            [['code_no'],'string','max'=>50],
            [['store_own_sex','evidence_complete','store_area_type'],'string','max'=>1],            
            [['store_own_cid'], 'string','max'=>13],
            [['status'],'default','value'=>1],
            [['store_own_nation'],'default','value'=>'099'],
            [['place_request'],'default','value'=>'สำนักงานเทศบาลตำบล'],
            [['store_name', 'store_type', 'store_addr', 'store_moo'
                , 'store_tmb', 'store_amp', 'store_chw', 'store_phone'
                ,'store_own_pname', 'store_own_fname', 'store_own_lname'
                , 'store_own_age', 'store_own_nation','place_request'
                ,'store_own_addr','store_own_moo','store_own_tmb','store_own_amp','store_own_chw'], 'string', 'max' => 255],
        ];
    }

 public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {   
        return is_array($value)?implode(',', $value):NULL;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!empty($this->evidence)){
                $this->evidence = $this->setToArray($this->evidence);
                $this->evidence_other = $this->setToArray($this->evidence_other); 
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function getEvidenceName(){
    $eviden = ArrayHelper::map(Evidence::find()->all(),'id','evidence');
    $evidenSelect = explode(',', $this->evidence);
    $evidenSelectName = [];     
    foreach ($eviden as $key => $evidencesname) { 
      foreach ($evidenSelect as $evidenKey) {       
        if($key === (int)$evidenKey){
       $evidenSelectName[] = $evidencesname;
        }
      }        
    }   
    return implode(' , ', $evidenSelectName);
}

public function getEvidenceotherName(){
    $eviden = ArrayHelper::map(Evidence::find()->all(),'id','evidence');
    $evidenSelect = explode(',', $this->evidence_other);
    $evidenSelectName = [];     
    foreach ($eviden as $key => $evidencesname) { 
      foreach ($evidenSelect as $evidenKey) {       
        if($key === (int)$evidenKey){
       $evidenSelectName[] = $evidencesname;
        }
      }        
    }   
    return implode(' , ', $evidenSelectName);
}

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_no' => 'รหัสรับเรื่อง',
            'store_name' => 'ชื่อสถานประกอบการ',
            'store_type' => 'ประเภทแบบคำขอ',
            'store_area'=>'จำนวนพื้นที่ตั้ง',
            'store_addr' => 'เลขที่ตั้ง-ร้าน',
            'store_moo' => 'หมู่-ร้าน',
            'store_tmb' => 'ต.-ร้าน',
            'store_amp' => 'อ.-ร้าน',
            'store_chw' => 'จ.-ร้าน',
            'store_phone' => 'หมายเลขโทรศัพท์',
            'date_request' => 'วันที่รับเรื่อง',
            'evidence' => 'หลักฐาน',
            'evidence_other' => 'หลักฐานที่ยังไม่ครบ',
            'store_own_pname'=>'คำนำหน้า',
            'store_own_fname' => 'ชื่อเจ้าของกิจการ',
            'store_own_lname' => 'นามสกุลเจ้าของกิจการ',
            'store_own_age' => 'อายุ',
            'store_own_nation' => 'สัญชาติ',
            'user_id' => 'เจ้าหน้าที่',
            'date_key' => 'วันที่บันทึก',
            'status' => 'สถานะคำขอ',
            'place_request'=>'เขียนที่',
            'store_own_cid'=>'เลขที่บัตรประชาชน',
            'store_own_dob'=>'วันเกิด',
            'store_own_sex'=>'เพศ',
            'evidence_complete'=>'ความพร้อมของเอกสาร/หลักฐาน',
            'store_type_id'=>'ประเภทของกิจการ',
            'store_own_addr'=>'เลขที่ตั้ง',
            'store_own_moo'=>'หมู่ที่',
            'store_own_tmb'=>'ตำบล',
            'store_own_amp'=>'อำเภอ',
            'store_own_chw'=>'จังหวัด',
            'store_area_type'=>'ประเภทพื้นที่ตั้ง',
            'storetypes'=>'ประเภท'
        ];
    }
    
    public function Oknumber(){
        $tbyear = TbYearNumber::find()->where(['status'=>1])->one()->no_number;
        $count = Receive::find()->count();        
        $okno = $notbyear.' / '.$count;
        return;
    }
    
    public function getStoretype(){
        return $this->hasOne(StoreType::className(), ['id'=>'store_type_id']);
    }
    public function getServicename(){
        return $this->hasOne(\app\models\Users::className(), ['id'=>'user_id']);
    }
    public function getNation(){
        return $this->hasOne(ProvisNation::className(), ['code'=>'store_own_nation']);
    }
}
