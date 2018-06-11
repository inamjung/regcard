<?php

namespace app\modules\kpi\models;

use Yii;
use app\modules\kpi\models\Kpidata;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

/**
 * This is the model class for table "kpi".
 *
 * @property integer $id
 * @property string $kpiname
 * @property string $kpidesc
 * @property integer $kpitype_id
 * @property string $kpiyear
 * @property integer $period_id
 * @property string $d_begin_year
 * @property string $goal
 * @property string $denom
 * @property string $devide
 * @property string $goal_des
 * @property string $target
 * @property string $target_des
 * @property string $denom_c
 * @property string $denom_c_unit
 * @property string $divide_c
 * @property string $devide_c_unit
 * @property string $critiria_value
 * @property string $sourcekpi
 * @property integer $kpidepart_id
 * @property string $user_kpi
 * @property integer $statuskpi
 * @property integer $useradd_id
 * @property string $d_add
 * @property integer $useredit_id
 * @property string $d_edit
 * @property string $operation
 * @property string $formula
 * @property string $docs
 * @property string $ref
 */
class Kpi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const UPLOAD_FOLDER = 'kpifiles';
    public static function tableName()
    {
        return 'kpi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpidesc', 'goal_des', 'target_des', 'critiria_value'], 'string'],
            [['kpitype_id', 'period_id', 'kpidepart_id', 'statuskpi', 'useradd_id', 'useredit_id'], 'integer'],
            [['kpiyear', 'period_id', 'kpidepart_id','operation','goal'], 'required'],
            [['d_begin_year', 'd_add', 'd_edit'], 'safe'],
            [['goal', 'denom', 'devide', 'target', 'denom_c', 'devide_c'], 'number'],
            [['kpiname'], 'string', 'max' => 300],
            [['kpiyear'], 'string', 'max' => 4],
            [['denom_c_unit', 'devide_c_unit', 'sourcekpi'], 'string', 'max' => 100],
            [['user_kpi', 'formula', 'docs', 'ref'], 'string', 'max' => 255],
            [['operation'], 'string', 'max' => 2],
            
            [['docs'],'file','maxFiles'=>5,'skipOnEmpty'=>true],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpiname' => 'ตัวชี้วัด',
            'kpidesc' => 'คำอธิบายตัวชี้วัด',
            'kpitype_id' => 'ลักษณะตัวชี้วัด',
            'kpiyear' => 'ปีงบประมาณ',
            'period_id' => 'ความถี่การประมวลผล ครั้ง/ปี',
            'd_begin_year' => 'วันที่เริ่มตัวชี้วัด',
            'goal' => 'เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
            'denom' => 'ตัวตั้ง(ผลงาน)',
            'devide' => 'ตัวหาร(เป้า)',
            'goal_des' => 'คำอธิบาย เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
            'target' => 'กลุ่มเป้าหมาย',
            'target_des' => 'คำอธิบายเป้าหมายตามตัวชี้วัด(B ตัวหาร)',
            'denom_c' => 'ตัวตั้งคงที่',
            'denom_c_unit' => 'หน่วยนับตัวตั้ง',
            'devide_c' => 'ตัวหารคงที่',
            'devide_c_unit' => 'หน่วยนับตัวหาร',
            'critiria_value' => 'เกณฑ์การให้คะแนน',
            'sourcekpi' => 'แหล่งข้อมูล',
            'kpidepart_id' => 'งานที่รับผิดชอบ',
            'user_kpi' => 'ผู้รับผิดชอบ',
            'statuskpi' => 'สถานะ',
            'useradd_id' => 'ผู้บันทึก',
            'd_add' => 'D Add',
            'useredit_id' => 'ผู้แก้ไข',
            'd_edit' => 'D Edit',
            'operation' => 'ค่าดัชนีทีใช้วัด',
            'formula' => 'สูตรที่ใช้คำนวนผล',
            'docs' => 'เอกสารประกอบ',
            'ref' => 'Ref',
        ];
    }
    
    public function getTokpidata(){
        return $this->hasMany(Kpidata::className(), ['kpi_id'=>'id']);
    }
    public function getTypes(){
        return $this->hasOne(Kpitype::className(), ['id'=>'kpitype_id']);
    }
    public function getDep(){
        return $this->hasOne(Kpidepart::className(), ['id'=>'kpidepart_id']);
    }
    public function getPeriods(){
        return $this->hasOne(Kpiperiod::className(), ['id'=>'period_id']);
    }
    public function getDperiods(){
        return $this->periods->period;
    }
    public function getDtotal(){
        return $this->periods->d_total;
    }
    
//    อับโหลดเอกสาร
    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function listDownloadFiles($type){
     $docs_file = '';
     if(in_array($type, ['docs'])){         
             $data = $type==='docs'?$this->docs:$this->docs;
             $files = Json::decode($data);
            if(is_array($files)){
                 $docs_file ='<ul>';
                 foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['/kpi/kpi/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
                 }
                 $docs_file .='</ul>';
            }
     }
     
     return $docs_file;
    }

    public function initialPreview($data,$field,$type='file'){
            $initial = [];
            $files = Json::decode($data);
            if(is_array($files)){
                 foreach ($files as $key => $value) {
                    if($type=='file'){
                        $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                    }elseif($type=='config'){
                        $initial[] = [
                            'caption'=> $value,
                            'width'  => '20px;',
                            'url'    => Url::to(['/kpi/kpi/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                            'key'    => $key
                        ];
                    }
                    else{
                        $initial[] = Html::img(self::getUploadUrl().$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'name'=>$model->file_name]);
                        //$initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'name'=>$model->file_name]);
                    }
                 }
         }
        return $initial;
    }
     //  จบ  อับโหลดเอกสาร
}
