<?php

namespace app\modules\kpi\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

/**
 * This is the model class for table "kpi".
 *
 * @property integer $id
 * @property integer $kpi_h_id
 * @property string $kpiname
 * @property string $kpiyear
 * @property integer $period_id
 * @property string $d_begin_year
 * @property string $goal
 * @property string $goal_des
 * @property string $denom
 * @property string $denom_c
 * @property string $denom_c_unit
 * @property string $devide
 * @property string $devide_c
 * @property string $devide_c_unit
 * @property string $target
 * @property string $target_des
 * @property string $critiria_value
 * @property integer $kpidepart_id
 * @property string $user_kpi
 * @property integer $statuskpi
 * @property integer $user_result_id
 * @property string $d_add
 * @property integer $user_edit_result_id
 * @property string $update_d
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
    
    const UPLOAD_FOLDER = 'kpitemplates';
    public $deps;
    //public $countdeps;
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
            [['period_id', 'kpidepart_id', 'statuskpi', 'user_result_id', 'user_edit_result_id','level_id_1','level_id_2','level_id_3'], 'integer'],
            [['kpiyear','period_id','kpiname','operation'], 'required'],
            [['d_begin_year', 'd_add', 'update_d','level_id','deps'], 'safe'],
            [['goal', 'denom', 'denom_c', 'devide', 'devide_c', 'target'], 'number'],
            [['goal_des', 'target_des', 'critiria_value'], 'string'],
            [['kpiname'], 'string', 'max' => 300],
            [['kpi_h_id', 'kpiyear'], 'string', 'max' => 4],
            [['denom_c_unit', 'devide_c_unit'], 'string', 'max' => 100],
            [['user_kpi', 'formula', 'docs', 'ref'], 'string', 'max' => 255],
            [['operation'], 'string', 'max' => 2],            
            [['docs'],'file','maxFiles'=>1,'skipOnEmpty'=>true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kpi_h_id' => 'รหัสตัวชี้วัด',
            'kpiname' => 'รายการตัวชี้วัด',
            'kpiyear' => 'ปีงบ',
            'period_id' => 'ความถี่',
            'd_begin_year' => 'วันที่เริ่มตัวชี้วัด',
            'goal' => 'เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
            'goal_des' => 'คำอธิบาย เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
            'denom' => 'ตัวตั้ง(ผลงาน)',
            'denom_c' => 'ตัวตั้งคงที่',
            'denom_c_unit' => 'หน่วยนับตัวตั้ง',
            'devide' => 'ตัวหาร(เป้า)',
            'devide_c' => 'ตัวหารคงที่',
            'devide_c_unit' => 'หน่วยนับตัวหาร',
            'target' => 'กลุ่มเป้าหมาย',
            'target_des' => 'คำอธิบาย กลุ่มเป้าหมายตามตัวชี้วัด(B ตัวหาร)',
            'critiria_value' => 'เกณฑ์การให้คะแนน',
            'kpidepart_id' => 'งานที่รับผิดชอบ',
            'user_kpi' => 'ชื่อผู้รับผิดชอบ',
            'statuskpi' => 'สถานะ',
            'user_result_id' => 'ผู้บันทึกผล',
            'd_add' => 'D Add',
            'user_edit_result_id' => 'ผู้แก้ไข',
            'update_d' => 'Update D',
            'operation' => 'ค่าดัชนีทีใช้วัด',
            'formula' => 'สูตรที่ใช้คำนวนผล',
            'docs' => 'เอกสารประกอบ',
            'ref' => 'Ref',            
            'level_id'=>'ประเภทตัวชี้วัด',
            'deps'=>'ผู้รับผิดชอบ'
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
     public function getTokpidata(){
        return $this->hasMany(Kpidata::className(), ['kpi_id'=>'id']);
    }
    public function getTypes(){
       // return $this->hasOne(Kpitype::className(), ['id'=>'kpitype_id']);
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
    public function getKyear(){
        return $this->hasOne(Kpiyear::className(), ['kpiyear'=>'kpiyear']);
    }
     public function getLevel(){
        return $this->hasOne(KLevel::className(), ['id'=>'level_id']);
    }
    

    public function Checkval($id){
        //$categoriesList = array();
        $cdatarow = Kpidata::find()->where(['kpi_id'=>$id])->one();
        //$count = Kpidata::find()->where(['not',['denom'=>null]])->andWhere(['not',['devide'=>null]])->andWhere(['kpi_id'=>$id])->count();
        $totaldata = @($cdatarow->denom / $cdatarow->devide) * $cdatarow->denom_c;
    }
    
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
                            'width'  => '120px',
                            'url'    => Url::to(['/kpi/kpi/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                            'key'    => $key
                        ];
                    }
                    else{
                        $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                    }
                 }
         }
        return $initial;
    }
    
    public function Checkvals($id){
        //$model = Kpi::find()->where(['id'=>$id])->one();
        $models = Kpidata::find()->where(['kpi_id'=>$id])->one();
        $totaldatas = @($models->denom / $models->devide) * $models->denom_c;
 
            //operation '<='
        if($models->operation == '<=' & $models->goal >= $totaldatas & $totaldatas != 0){
            return '<span style="color: green"> </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
        } elseif ($models->operation == '<=' & $models->goal < $totaldatas & $totaldatas != 0) {
            return '<span style="color: red"> </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
        } else {
            return '<span style="color: #141415;"> </span><i style="color: #141415" class="glyphicon glyphicon-repeat"></i>';
        }
        
         //operation '>='
         if($models->operation == '>=' & $models->goal >= $totaldatas & $totaldatas != 0){
            return '<span style="color: red"> </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';             
        } elseif ($models->operation == '>=' & $models->goal < $totaldatas & $totaldatas != 0) {
            return '<span style="color: green"> </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
        } else {
            return '<span style="color: #141415;"> </span><i style="color: #141415" class="glyphicon glyphicon-repeat"></i>';
        }
//            if ($models->operation === '>=' && $totaldatas >= $models->goal) {
//                return '<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
//            } elseif ($models->operation === '>=' && $totaldatas > 0 && $totaldatas < $model->goal) {
//                return '<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
//            } else {
//                return '<span style="color: #141415;">รอผล </span><i style="color: #141415" class="glyphicon glyphicon-repeat"></i>';
//            
//            //operation '<='    
//            } 
//            if ($models->operation === '<=' && $totaldatas > $models->goal) {
//                return '<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
//            } elseif ($models->operation === '<=' && $totaldatas > 0 && $totaldatas <= $models->goal) {
//                return '<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
//                 
//            }
    }

    public function Countdeps(){
        $model = Kpi::find()
        //->select(['COUNT(*) AS cnt'])        
        ->groupBy('kpidepart_id')
         ->count();
        //return $leadsCount;
    } 
 
    public function Showtype($id){
        $types = Kpi::find()->where(['id'=>$id])->one();
        return $this->Showtype1($id).$this->Showtype2($id).$this->showtype3($id);
        
    }
    
    public function Showtype1($id){
        $types = Kpi::find()->where(['id'=>$id])->one();             
       if($types->level_id_1 == '1'){
           return "<span class='badge' style='background-color: blue'>moph</span>";
        } else {
             return '';
        } 
    }
    public function Showtype2($id){
        $types = Kpi::find()->where(['id'=>$id])->one();             
       if($types->level_id_2 == '1'){
           return "<span class='badge' style='background-color: skyblue'>PA</span>";
        } else {
             return '';
        } 
    }    
    public function Showtype3($id){
        $types = Kpi::find()->where(['id'=>$id])->one();             
       if($types->level_id_3 == '1'){
           return "<span class='badge' style='background-color: pink'>HA</span>";
        } else {
             return '';
        } 
    }
}
