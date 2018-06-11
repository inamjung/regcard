<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\checkbox\CheckboxX;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-form">


    <style media="screen">
        .form-group {
            margin-bottom: 0px;
        }
        .help-block {
            display: block;
            margin-top: 2px;
            margin-bottom: 2px;
            color: #737373;
        }
        .input-group {
            margin-bottom: 1px;
        }
        /*.col-sm-offset-1 {
            margin-left: 1%;
        }*/
        .modal.in .modal-dialog {
            width: 69%;
        }
        .from-box{
            display: inline-block;
            width: 400px;
            height: 30px;
            /* margin: 10px; */
            /* border: 3px solid #73AD21;  */
        }
    </style>
    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        //'label' => 'col-md-3',
                       'wrapper' => 'col-md-8'
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'kpiname',['horizontalCssClasses' => ['label' => 'col-md-1','wrapper' => 'col-md-10']])->textarea(['rows' => 3, 'placeHolder' => '...ระบุชื่อตัวชี้วัด','style'=>'margin: 0px 52px 0px 47px']) ?>
        </div>
    </div>    
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'kpi_h_id')->textInput(['placeHolder' => '...ระบุรหัสตัวชี้วัด']) ?> 
            
            <?=
            $form->field($model, 'kpiyear')->widget(kartik\widgets\Select2::className(), [
                'data' => yii\helpers\ArrayHelper::map(app\modules\kpi\models\Kpiyear::find()->all(), 'kpiyear', 'kpiyear'),
                'options' => [
                    'placeholder' => '..เลือกปีงบประมาณ...'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ])
            ?>
            <?=
            $form->field($model, 'period_id', ['labelOptions' => ['style' => 'color: red']])->widget(kartik\widgets\Select2::className(), [
                'data' => yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpiperiod::find()->all(), 'id', function($model, $defaultValue) {
                            return $model->period . ' ครั้ง/ปี : ' . $model->description;
                        }),
                'options' => [
                    'placeholder' => 'ความถี่การรายงานผล..',
                    'required' => ''
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]);
            ?>    


            <?php
            $datas = ['<=' => '<= (น้อยกว่าหรือเท่ากับ)', '>=' => '>= (มากกว่าหรือเท่ากับ)'];
            ?>
            <?=
            $form->field($model, 'operation', ['labelOptions' => ['style' => 'color: red']])->inline()->radioList($datas);?> 
            <?= $form->field($model, 'goal')->label('Goal')->textInput(['maxlength' => true, 'placeHolder' => '...กรอกตัวเลข Goal']) ?>     
            <?= $form->field($model, 'target')->textInput(['maxlength' => true, 'placeHolder' => '...กรอกตัวเลขของกลุ่มเป้าหมาย']) ?>
            <?= $form->field($model, 'formula')->textInput(['maxlength' => true, 'placeHolder' => '...ระบุสูตรที่ใช้คำนวน']) ?>
            <?= $form->field($model, 'denom_c')->label('ตัวคูณคงที่')->textInput(['maxlength' => true, 'placeHolder' => '...กรอกตัวเลขคงที่ ที่ใช้คำนวนตามสูตร']) ?>
            <?=
            $form->field($model, 'kpidepart_id')->widget(kartik\widgets\Select2::className(), [
                'data' => yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpidepart::find()->all(), 'id', 'kpi_dep'),
                'options' => [
                    'placeholder' => '..เลือกหน่วยงานรับผิดชอบ...'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ])
            ?>

            <?= $form->field($model, 'user_kpi')->textInput(['maxlength' => true, 'placeHolder' => '...ระบุรายชื่อ ข้อมูลการติดต่อของผู้รับผิดชอบ']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'goal_des')->label('คำอธิบาย Goal')->textarea(['rows' => 4, 'placeHolder' => '...ระบุรายละเอียดของ Goal']) ?>
            <?= $form->field($model, 'target_des')->textarea(['rows' => 4, 'placeHolder' => '...ระบุรายละเอียดของกลุ่มเป้าหมาย']) ?>  
            <?= $form->field($model, 'critiria_value')->textarea(['rows' => 4, 'placeHolder' => '...ระบุรายละเอียดของสูตรการคิดให้คะแนน']) ?>
            <?= $form->field($model, 'level_id_1')->widget(\kartik\checkbox\CheckboxX::className(),[
                    'pluginOptions'=>[
                        'threeState'=>FALSE
                    ]
                ])->label('kpiกระทรวง') ?>
                <?= $form->field($model, 'level_id_2')->widget(\kartik\checkbox\CheckboxX::className(),[
                    'pluginOptions'=>[
                        'threeState'=>FALSE
                    ]
                ])->label('kpiตรวจราชการ') ?>
            <?= $form->field($model, 'level_id_3')->widget(\kartik\checkbox\CheckboxX::className(),[
                    'pluginOptions'=>[
                        'threeState'=>FALSE
                    ]
                ])->label('HA/โรงพยาบาล') ?>
        </div>
    </div>
 <div class="row">
     <div class="col-md-4">
         
     </div>
     <div class="col-md-4">
         
     </div>
     <div class="col-md-4">
         
     </div>
 </div>

    <?php // $form->field($model, 'user_edit_result_id')->textInput() ?>    


    <?=
    $form->field($model, 'docs[]')->label('อับโหลดเทมเพลต')->widget(FileInput::classname(), [
        'options' => [
            //'accept' => 'image/*',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'initialPreview' => $model->initialPreview($model->docs, 'docs', 'file'),
            'initialPreviewConfig' => $model->initialPreview($model->docs, 'docs', 'config'),
            'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
            'showPreview' => FALSE,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            'overwriteInitial' => false
        ]
    ]);
    ?>  



    <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
