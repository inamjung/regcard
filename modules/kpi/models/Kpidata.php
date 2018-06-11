<?php

namespace app\modules\kpi\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
/**
 * This is the model class for table "kpidata".
 *
 * @property integer $id
 * @property integer $kpi_id
 * @property integer $frequency_no
 * @property string $d_end_result
 * @property string $denom
 * @property string $devide
 * @property string $devide_c
 * @property string $denom_c
 * @property string $result
 * @property string $result_text
 * @property string $calc
 * @property integer $user_id_result
 * @property string $d_add
 * @property string $d_edit
 * @property string $docs
 * @property string $goal
 * @property string $target
 * @property string $target_des
 * @property integer $qty_kan
 * @property integer $kan
 * @property integer $kpilist_id
 * @property string $ref
 */
class Kpidata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpidata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_id'], 'required'],
            [['kpi_id', 'frequency_no', 'user_id_result', 'qty_kan', 'kan', 'kpilist_id','period_id'], 'integer'],
            [['d_end_result', 'd_add', 'd_edit'], 'safe'],
            [['denom', 'devide', 'devide_c', 'denom_c', 'result', 'calc', 'goal', 'target'], 'number'],
            [['target_des'], 'string'],
            [['result_text', 'docs', 'ref'], 'string', 'max' => 255],
            [['operation','t'],'string','max'=>2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_id' => 'รหัส kpi',
            'frequency_no' => 'ครั้งที่บันทึก',
            'd_end_result' => 'ภายในวันที่',
            'denom' => 'ตัวตั้ง(ผลงาน)',
            'devide' => 'ตัวหาร(เป้า)',
            'devide_c' => 'ตัวตั้งคงที่',
            'denom_c' => 'ตัวหารคงที่',
            'result' => 'ค่าผลลัพธ์(ผลคำนวน)',
            'result_text' => 'ผลลัพธ์',
            'calc' => 'คำนวนได้',
            'user_id_result' => 'ผู้บันทึกผล kpi',
            'd_add' => 'วันที่บันทึก',
            'd_edit' => 'วันที่แก้ไข',
            'docs' => 'เอกสารแนบ',
            'goal' => 'เกณฑ์เป้าหมาย',
            'target' => 'กลุ่มเป้าหมาย',
            'target_des' => 'คำเป้าหมายตามตัวชี้วัด(B ตัวหาร)',
            'qty_kan' => 'จำนวนกณฑ์',
            'kan' => 'เกณฑ์',
            'kpilist_id' => 'kpi',
            'ref' => 'Ref',
            'operation'=>'ค่าดัชนี',
            'period_id'=>'ความถี่',
            't'=>'ไตรมาส'
        ];
    }
     public function getKpidata() {

        return $this->hasOne(Kpi::className(), ['id' => 'kpi_id']);
    }
}
