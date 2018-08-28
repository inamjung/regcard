<?php

namespace app\modules\license\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\license\models\StoreType;
use app\models\Users;

/**
 * This is the model class for table "receive_final".
 *
 * @property integer $id
 * @property integer $receive_id
 * @property integer $receive_confirm_id
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
 * @property integer $status
 * @property string $evidence_confirm
 * @property string $evidence_confirm_detail
 * @property integer $user_id_confirm
 * @property string $date_confirm
 * @property string $service_fee
 * @property string $bill_book
 * @property string $bill_no
 * @property string $bill_date
 * @property string $date_book_final
 * @property integer $user_id_final
 * @property string $final_date_start
 * @property string $final_date_exp
 * @property integer $store_type_id
 * @property string $store_person
 * @property string $store_area_type
 * @property string $store_own_addr
 * @property string $store_own_moo
 * @property string $store_own_tmb
 * @property string $store_own_amp
 * @property string $store_own_chw
 */
class ReceiveFinal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $typefinal;
    public $statusfinales;

    public static function tableName()
    {
        return 'receive_final';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receive_id', 'receive_confirm_id', 'user_id', 'user_id_confirm', 'user_id_final'], 'integer'],
            [['store_area', 'service_fee'], 'number'],
            [['date_request', 'store_own_dob', 'date_key', 'date_confirm', 'bill_date', 'date_book_final', 'final_date_start', 'final_date_exp', 'typefinal','statusfinales', 'store_type_id', 'status', 'store_moo'], 'safe'],
            [['code_no'], 'string', 'max' => 50],
            [['store_name', 'store_type', 'store_addr', 'store_tmb', 'store_amp', 'store_chw', 'store_phone', 'evidence', 'evidence_other', 'store_own_pname', 'store_own_fname', 'store_own_lname', 'store_own_age', 'store_own_nation', 'place_request', 'evidence_confirm_detail', 'bill_book', 'bill_no', 'store_person', 'store_own_addr', 'store_own_moo', 'store_own_tmb', 'store_own_amp', 'store_own_chw'], 'string', 'max' => 255],
            [['store_own_cid'], 'string', 'max' => 13],
            [['store_own_sex', 'evidence_confirm', 'store_area_type'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receive_id' => 'Receive ID',
            'receive_confirm_id' => 'Receive Confirm ID',
            'code_no' => 'รหัสรับเรื่อง',
            'store_name' => 'ชื่อสถานประกอบการ',
            'store_type' => 'ประเภท',
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
            'status' => 'สถานะคำขอ',
            'evidence_confirm' => 'ความพร้อมของเอกสาร',
            'evidence_confirm_detail' => 'เอกสาร/หลักฐานที่ไม่ครบ',
            'user_id_confirm' => 'เจ้าหน้าที่',
            'date_confirm' => 'วันที่',
            'service_fee' => 'ค่าธรรมเนียม',
            'bill_book' => 'ใบเสร็จเล่มที่',
            'bill_no' => 'ใบเสร็จเลขที่',
            'bill_date' => 'ลงวันที่ใบเสร็จ',
            'date_book_final' => 'วันที่หนังสือรับรอง',
            'user_id_final' => 'User Id Final',
            'final_date_start' => 'วันที่ออกใบอนุญาต',
            'final_date_exp' => 'วันสิ้นอายุใบอนุญาต',
            'store_type_id' => 'ประเภทของกิจการ',
            'store_person' => 'ชื่อผู้ประกอบกิจการ',
            'store_area_type' => 'ประเภทพื้นที่ตั้ง',
            'store_own_addr' => 'เลขที่ตั้ง',
            'store_own_moo' => 'หมู่ที่',
            'store_own_tmb' => 'ตำบล',
            'store_own_amp' => 'อำเภอ',
            'store_own_chw' => 'จังหวัด',
            'typefinal' => 'ประเภท',
            'statusfinales'=>'สถานะ'
        ];
    }
    
     public function getArray($value) {
        return explode(',', $value);
    }

    public function setToArray($value) {
        return is_array($value) ? implode(',', $value) : NULL;
    }

    public function getEvidenceNameFinal() {
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

    public function getEvidenceotherNameFinal() {
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

    public function getNation() {
        return $this->hasOne(ProvisNation::className(), ['code' => 'store_own_nation']);
    }

    public function getStoretypefinal() {
        return $this->hasOne(StoreType::className(), ['id' => 'store_type_id']);
    }

    public function getFinalname() {
        return $this->hasOne(\app\models\Users::className(), ['id' => 'user_id_final']);
    }

    public function getConfirmname() {
        return $this->hasOne(\app\models\Users::className(), ['id' => 'user_id_confirm']);
    }

    public function getStatusfinal(){
        return $this->hasOne(Status::className(), ['id'=>'status']);
    }
}
