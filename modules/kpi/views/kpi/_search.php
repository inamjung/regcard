<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

//use app\modules\risk\models\Levels;
?>

<div class="riskreports-search">
    <style media="screen">
        .form-group {
            margin-bottom: 0px;
        }
        .help-block {
           
            margin-top: 1px;
            margin-bottom: 1px;
            color: #737373;
        }
        .input-group {
            margin-bottom: 1px;
        }
        /*.col-sm-offset-1 {
            margin-left: 1%;
        }*/
  
    </style>
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['data-pjax' => true]
    ]);
    ?>

    <div class="row">
        <div class="col-md-2">
            
            <?= $form->field($model, 'level_id_1')->label('')->radioList([''=>'ไม่ใช่',1=>'kpi-กระทรวง']); ?>
            <?= $form->field($model, 'level_id_2')->label('')->radioList([''=>'ไม่ใช่',1=>'kpi-ตรวจราชการ']); ?>
            <?= $form->field($model, 'level_id_3')->label('')->radioList([''=>'ไม่ใช่',1=>'kpi-HA/โรงพยาบาล']); ?> 
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'deps')->label('ผู้รับผิดชอบ')->widget(select2::classname(), [
            'data'=> ArrayHelper::map(\app\modules\kpi\models\Kpidepart::find()->orderBy('kpi_dep')->all(),'id','kpi_dep'),
            'options' => [
              'id' => 'deps','placeholder' => 'เลือกงาน..',],
              'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,              
                ]]);
              ?>
        </div>   
        <div class="col-md-3">

        </div>   
    </div>     
    <div class="row">
        <div class="col-md-3">
            <div class="form-group" style="margin-top:25px;">
                <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> ค้นหา', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-refresh" aria-hidden="true"></i> คืนค่า', [''], ['class' => 'btn btn-default']); ?>

            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

