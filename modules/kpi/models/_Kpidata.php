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
 * @property string $ref
 * @property string $goal
 * @property string $target
 * @property integer $qty_kan
 * @property integer $kan
 * @property integer $kpilist_id
 */
class Kpidata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const UPLOAD_FOLDER = 'kpidatafiles';
    
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
            [['target_des'], 'string'],
            [['kpi_id', 'frequency_no', 'user_id_result', 'qty_kan', 'kan', 'kpilist_id'], 'integer'],
            [['d_end_result', 'd_add', 'd_edit'], 'safe'],
            [['denom', 'devide', 'devide_c', 'denom_c', 'result', 'calc', 'goal', 'target'], 'number'],
            [['result_text', 'docs', 'ref'], 'string', 'max' => 255],
                        
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
            'ref' => 'Ref',
            'goal' => 'เกณฑ์เป้าหมาย',
            'target' => 'กลุ่มเป้าหมาย',
            'qty_kan' => 'จำนวนกณฑ์',
            'kan' => 'เกณฑ์',
            'kpilist_id' => 'kpi',
            'target_des'=>'คำเป้าหมายตามตัวชี้วัด(B ตัวหาร)'
        ];
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
                    $docs_file .= '<li>'.Html::a($value,['/kpi/kpidata/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
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
                            'url'    => Url::to(['/kpi/kpidata/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
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
