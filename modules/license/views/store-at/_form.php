<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use app\modules\license\models\Evidence;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\modules\license\models\ProvisNation;
use app\modules\license\models\TbYearNumber;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\SurveyDetailText;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\detail\DetailView;
?>

<div class="store-at-form">
    <style>
        .form-group {
            margin-bottom: 1px;
        }
        .help-block {
            display: block;
            margin-top: 1px;
            margin-bottom: 1px;
            color: #737373;
        }
        .input-group {
            margin-bottom: 1px;
        }    
        .modal.in .modal-dialog {
            width: 70%;
        }  
    </style>

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-md-3',
                        'wrapper' => 'col-md-9',
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>

    <div class="col-md-6">    
        <div class="panel panel-default">
            <div class="panel-heading">ข้อมูลการยื่นคำขอ
            <a class="btn btn-info" onclick="return getToMap(<?=$model->store_own_cid;?>)">ดึงพิกัดที่ตั้งร้านจากทะเบียน</a>
            </div>
            <div class="panel-body">
                <?=
                $form->field($model, 'code_no')->textInput(['readonly' => true,
                ])->label('เลขที่')
                ?>    
                <?php // $form->field($model, 'place_request')->textInput(['maxlength' => true, 'placeholder' => 'ระบุสถานที่ หากไม่ได้เขียนที่สำนักงานเทศบาล..']) ?>
                <?=
                $form->field($model, 'date_request')->widget(DateControl::classname(), [
                    'type' => DateControl::FORMAT_DATE,
                    'language' => 'th',
                    'disabled' => true,
                    'ajaxConversion' => false,
                    'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
                ]);
                ?>
                <?php
                $liste = ['1' => 'ขอรับ/ต่ออายุใบอนุญาต', '2' => 'ขอจัดตั้งสถานที่'];
                echo $form->field($model, 'store_type')->dropDownList($liste, ['prompt' => 'ระบุประเภทคำขอ..', 'disabled' => true])
                ?>
                <?= $form->field($model, 'store_name')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                <?= $form->field($model, 'store_area')->textInput(['maxlength' => true])->label('พื้นที่ตั้ง(ตร.เมตร)') ?>

                <hr>

                <?= $form->field($model, 'store_own_cid')->textInput(['readonly' => true, 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>
                <?= $form->field($model, 'store_person')->textInput(['readonly' => true, 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>
                <?= $form->field($model, 'store_own_age')->textInput(['readonly' => true, 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>                  
                <?= $form->field($model, 'store_addr')->textInput(['readonly' => true, 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>                     

                <?php
                $url = \yii\helpers\Url::to(['nation-list']);
                $nation = empty($model->store_own_nation) ? '' : ProvisNation::findOne($model->store_own_nation)->name; //กำหนดค่าเริ่มต้น
                echo $form->field($model, 'store_own_nation')->widget(select2::classname(), [
                    'initValueText' => $nation,
                    'options' => ['id' => 'store_own_nation', 'disabled' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 2,
                        'placeholder' => '--- สัญชาติ ---',
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => $url,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(nation) { return nation.text; }'),
                        'templateSelection' => new JsExpression('function(nation) { return nation.text; }'),
                    ],
                ]);
                ?>  
                <?= $form->field($model, 'lat')->textInput([ 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>                  
                <?= $form->field($model, 'lng')->textInput([ 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>  

                <?=
                        $form->field($model, 'store_phone')
                        ->widget(MaskedInput::className(), ['mask' => '999-999-9999',
                            'options' => ['class' => 'form-control', 'disabled' => true],]);
                ?> 


                <?= $form->field($model, 'store_own_dob')->hiddenInput(['maxlength' => true])->label(FALSE) ?>
                <?= $form->field($model, 'store_own_sex')->hiddenInput(['maxlength' => true])->label(FALSE) ?>
                <?php //echo $form->field($model, 'status')->textInput()       ?>
            </div>
        </div>
        <?php   
        echo Html::a('<i class="glyphicon glyphicon-pushpin"></i> แผนที่ตั้งของสถานประกอบกิจการ', [
            'map', 'cid' => $model->store_own_cid], ['class'=>'btn btn-primary btn-sm','target'=>'_bank'
        ]); 
        ?>
    </div>



    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"> บันทึกผลการสำรวจสถานประกอบกิจการ</div>
            <div class="panel-body">

                <?=
                $form->field($model, 'date_survey')->widget(DateControl::classname(), [
                    'type' => DateControl::FORMAT_DATE,
                    'language' => 'th',
                    //'disabled'=> $model->rm_approve == 1,
                    'ajaxConversion' => false,
                    'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
                ]);
                ?>
                <?=
                $form->field($model, 'survey_type')->radioList([
                    '1' => 'ครบถ้วนถูกต้องตามข้อกำหนดไว้ในข้อกำหนดของท้องถิ่น', '2' => 'ไม่ครบ ดังนี้'
                ])
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">  </div>
                    <div class="panel-body"> 
                        <div class="row">
                            <?php
                            echo $this->render('@app/modules/license/views/survey-detail-type/create', [
                                'model' => new SurveyDetailType(),
                                'id' => $model->id
                            ]);
                            ?>
                            <div id="show"></div>
                        </div>
                    </div>
                </div>

                <hr>
                <?=
                $form->field($model, 'survey_text')->radioList([
                    '1' => 'ไม่สมควรอนุญาต', '2' => 'สมควรอนุญาต', '3' => 'สมควรอนุญาตโดยมีเงื่อนไข ดังนี้'
                ])
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">  </div>
                    <div class="panel-body"> 
                        <div class="row">
                            <?php
                            echo $this->render('@app/modules/license/views/survey-detail-text/create', [
                                'model' => new SurveyDetailText(),
                                'id' => $model->id
                            ]);
                            ?>
                            <div id="showtext"></div>
                        </div>
                    </div>
                </div>


                <?= $form->field($model, 'status')->inline()->radioList([1 => 'รอบันทึกผลตรวจ', 4 => 'บันทึกผลตรวจแล้ว'])->label('ยืนยันการตรวจ') ?>                
                <?= $form->field($model, 'user_survey')->widget(\kartik\widgets\Select2::className(),[
                    'data'=> ArrayHelper::map(\app\models\Users::find()->all(), 'id', 'name'),
                    'options'=>[
                        'placeholder'=>'<ผู้ออกสำรวจ>'
                    ],
                    'pluginOptions'=>[
                        'allowClear'=>true
                    ]
                ]) ?>

            </div>       
        </div>
    </div>       





    <?php //echo $form->field($model, 'store_moo')->textInput(['maxlength' => true])       ?>

    <?php //echo  $form->field($model, 'store_tmb')->textInput(['maxlength' => true])       ?>

    <?php //echo $form->field($model, 'store_amp')->textInput(['maxlength' => true])        ?>

    <?php //echo $form->field($model, 'store_chw')->textInput(['maxlength' => true])         ?>









    <?php ActiveForm::end(); ?>


    <?php
    $js = <<< JS
$.fn.modal.Constructor.prototype.enforceFocus = function() {};        
   
JS;
    $this->registerJS($js);
    ?>
    <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyBSsKUzYG_Wz7u2qL6unHqfBOmvaZ0H1Mg&callback=initMap">
    </script>