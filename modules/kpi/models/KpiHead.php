<?php

namespace app\modules\kpi\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
/**
 * This is the model class for table "kpi_head".
 *
 * @property integer $id
 * @property integer $mond_id
 * @property integer $pan_id
 * @property integer $kong_id
 * @property integer $level_id
 * @property string $name_h
 * @property integer $kpitype_id
 * @property string $kpidesc
 * @property string $perfomance
 * @property string $target
 * @property string $fomula
 * @property string $source
 * @property string $kpiyear
 * @property integer $kpidepart_id
 * @property string $user_kpi_h
 * @property integer $statuskpi
 * @property integer $user_id
 * @property string $docs
 * @property string $ref
 * @property string $create_d
 * @property string $upadte_d
 */
class KpiHead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpi_head';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mond_id', 'pan_id', 'kong_id', 'kpitype_id', 'kpidepart_id', 'statuskpi', 'user_id'], 'integer'],
            [['kpidesc', 'perfomance', 'target', 'fomula'], 'string'],
            [['kpiyear'], 'required'],
            [['create_d', 'upadte_d', 'level_id'], 'safe'],
            [['name_h'], 'string', 'max' => 300],
            [['source', 'user_kpi_h', 'docs', 'ref'], 'string', 'max' => 255],
            [['kpiyear'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mond_id' => 'หมวด',
            'pan_id' => 'แผน',
            'kong_id' => 'โครงการ',
            'level_id' => 'ระดับการแสดงผล',
            'name_h' => 'ชื่อตัวชี้วัด',
            'kpitype_id' => 'ลักษณะตัวชี้วัด',
            'kpidesc' => 'คำนิยาม',
            'perfomance' => 'วัตถุประสงค์',
            'target' => 'กลุ่มเป้าหมาย',
            'fomula' => 'สูตรคำนวนตัวชี้วัด',
            'source' => 'แหล่งข้อมูล',
            'kpiyear' => 'ปี kpi',
            'kpidepart_id' => 'งานที่รับผิดชอบ kpi',
            'user_kpi_h' => 'ชื่อผู้รับผิดชอบหลัก kpi',
            'statuskpi' => 'สถานะ',
            'user_id' => 'ผู้บันทึกรายการ',
            'docs' => 'เอกสารประกอบ',
            'ref' => 'Ref',
            'create_d' => 'วันที่บันทึก',
            'upadte_d' => 'วันที่แก้ไข',
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
            if(!empty($this->level_id)){
                $this->level_id = $this->setToArray($this->level_id);                
            }
            return true;
        } else {
            return false;
        }
    }
    public function getLname(){
        return $this->hasOne(KLevel::className(), ['id'=>'level_id']);
    }
    
}
