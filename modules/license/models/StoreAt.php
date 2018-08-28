<?php

namespace app\modules\license\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\license\models\Evidence;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\SurveyType;
use app\modules\license\models\StoreType;
/**
 * This is the model class for table "store_at".
 *
 * @property integer $id
 * @property integer $receive_id
 * @property string $code_no
 * @property string $store_name
 * @property string $store_type
 * @property double $store_area
 * @property string $store_addr
 * @property string $store_moo
 * @property string $store_tmb
 * @property string $store_amp
 * @property string $store_chw
 * @property string $store_phone
 * @property string $date_request
 * @property string $evidence
 * @property string $evidence_other
 * @property string $store_own_cid
 * @property string $store_own_pname
 * @property string $store_own_fname
 * @property string $store_own_lname
 * @property string $store_own_dob
 * @property string $store_own_age
 * @property string $store_own_sex
 * @property string $store_own_nation
 * @property integer $user_id
 * @property string $place_request
 * @property string $date_key
 * @property string $incontrol
 * @property string $lat
 * @property string $lng
 * @property string $survey_type
 * @property string $survey_text
 * @property string $date_survey
 * @property string $user_survey
 * @property integer $status
 */
class StoreAt extends \yii\db\ActiveRecord {

    public $storetypeat;
    
    public static function tableName() {
        return 'store_at';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['receive_id', 'user_id', 'status','store_type_id'], 'integer'],
            [['store_area'], 'number'],
            [['date_request', 'store_own_dob', 'date_key', 'date_survey'
                , 'evidence', 'evidence_other','storetypeat'], 'safe'],
            [['code_no'], 'string', 'max' => 50],
            [['store_name', 'store_type', 'store_addr', 'store_moo', 'store_tmb'
                , 'store_amp', 'store_chw', 'store_phone', 'store_own_pname'
                , 'store_own_fname', 'store_own_lname', 'store_own_age', 'store_own_nation'
                , 'place_request', 'lat', 'lng', 'user_survey','store_person'
                ,'store_own_addr','store_own_moo','store_own_tmb','store_own_amp','store_own_chw'], 'string', 'max' => 255],
            [['store_own_cid'], 'string', 'max' => 13],
            [['store_own_sex', 'incontrol', 'survey_type', 'survey_text','store_area_type'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'receive_id' => 'Receive ID',
            'code_no' => 'รหัสรับเรื่อง',
            'store_name' => 'ชื่อสถานประกอบการ',
            'store_type' => 'ประเภทแบบคำขอ',
            'store_area' => 'จำนวนพื้นที่ตั้ง',
            'store_addr' => 'เลขที่ตั้ง-ร้าน',
            'store_moo' => 'หมู่-ร้าน',
            'store_tmb' => 'ต.-ร้าน',
            'store_amp' => 'อ.-ร้าน',
            'store_chw' => 'จ.-ร้าน',
            'store_phone' => 'หมายเลขโทรศัพท์',
            'date_request' => 'วันที่รับเรื่อง',
            'evidence' => 'หลักฐาน',
            'evidence_other' => 'หลักฐานที่ยังไม่ครบ',
            'store_own_cid' => 'เลขที่บัตรประชาชน',
            'store_own_pname' => 'คำนำหน้า',
            'store_own_fname' => 'ชื่อเจ้าของกิจการ',
            'store_own_lname' => 'นามสกุลเจ้าของกิจการ',
            'store_own_dob' => 'วันเกิด',
            'store_own_age' => 'อายุ',
            'store_own_sex' => 'เพศ',
            'store_own_nation' => 'สัญชาติ',
            'user_id' => 'เจ้าหน้าที่',
            'place_request' => 'เขียนที่',
            'date_key' => 'วันที่บันทึก',
            'incontrol' => 'ในเขตเทศบาล',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'survey_type' => 'ข้อกำหนด',
            'survey_text' => 'ความเห็นผู้สำรวจ',
            'date_survey' => 'วันที่ตรวจ',
            'user_survey' => 'ผู้ตรวจ',
            'status' => 'สถานะคำขอ',
            'store_type_id'=>'ประเภทของกิจการ',
            'store_person'=>'ชื่อผู้ประกอบกิจการ',
            'store_own_addr'=>'เลขที่ตั้ง',
            'store_own_moo'=>'หมู่ที่',
            'store_own_tmb'=>'ตำบล',
            'store_own_amp'=>'อำเภอ',
            'store_own_chw'=>'จังหวัด',
            'store_area_type'=>'ประเภทพื้นที่ตั้ง',
            'storetypeat'=>'ประเภท'
        ];
    }


    public function getEvidenceNameAt() {
        $eviden = ArrayHelper::map(Evidence::find()->all(), 'id', 'evidence');
        $evidenSelect = explode(',', $this->evidence);
        $evidenSelectName = [];
        foreach ($eviden as $key => $evidencesname) {
            foreach ($evidenSelect as $evidenKey) {
                if ($key === (int) $evidenKey) {
                    $evidenSelectName[] = $evidencesname;
                }
            }
        }
        return implode(' , ', $evidenSelectName);
    }

    public function getEvidenceotherNameAt() {
        $eviden = ArrayHelper::map(Evidence::find()->all(), 'id', 'evidence');
        $evidenSelect = explode(',', $this->evidence_other);
        $evidenSelectName = [];
        foreach ($eviden as $key => $evidencesname) {
            foreach ($evidenSelect as $evidenKey) {
                if ($key === (int) $evidenKey) {
                    $evidenSelectName[] = $evidencesname;
                }
            }
        }
        return implode(' , ', $evidenSelectName);
    }

    public function getTexts() {
        return $this->hasMany(SurveyDetailText::className(), ['store_at_id' => 'id']);
    }

    public function getTypes() {
        return $this->hasMany(SurveyDetailType::className(), ['store_at_id' => 'id']);
    }
    public function getAtuser(){
        return $this->hasOne(\app\models\Users::className(), ['id'=>'user_survey']);
    }
    
    public function getAtstoretype(){
        return $this->hasOne(StoreType::className(), ['id'=>'store_type_id']);
    }
    
    public function getNationat(){
        return $this->hasOne(ProvisNation::className(), ['code'=>'store_own_nation']);
    }

}
