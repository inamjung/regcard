<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\modules\license\models\ProvisNation;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\StoreAt;
use app\modules\license\models\SurveyType;

use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\Evidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
?>

<div class="receive-final-form">
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
            width: 80%;
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
    <div class="panel panel-default">
        <div class="panel-heading"> ข้อมูลคำขอ / ผลการตรวจสภาพสถานประกอบกิจการการ</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6"> 
                    <?= $form->field($model, 'code_no')->textInput(['readonly' => true])->label('เลขที่') ?>    
                    <?= $form->field($model, 'place_request')->textInput(['readonly' => true, 'maxlength' => true, 'placeholder' => 'ระบุสถานที่ หากไม่ได้เขียนที่สำนักงานเทศบาล..']) ?>
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
                    <?= $form->field($model, 'store_name')->textInput(['readonly' => true, 'maxlength' => true]) ?>
                    <?= $form->field($model, 'store_area')->textInput(['readonly' => true, 'maxlength' => true, 'placeholder' => 'ระบุจำนวนพื้นที่ตั้งกิจการเป็นหน่วยตารางเมตร..'])->label('พื้นที่ตั้ง(ตร.เมตร)') ?>
                    <?= $form->field($model, 'store_own_cid')->textInput(['readonly' => true, 'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>
                    <?= $form->field($model, 'store_person')->textInput(['readonly' => true,'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>
                    <?= $form->field($model, 'store_own_age')->textInput(['readonly' => true,'maxlength' => true, 'style' => 'background-color: #cdd7c99c;']) ?>                    
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
                    <?=
                            $form->field($model, 'store_phone')
                            ->widget(MaskedInput::className(), ['mask' => '999-999-9999',
                                'options' => ['class' => 'form-control', 'disabled' => true],]);
                    ?> 
                </div>                
                <div class="col-md-6">
                    <table>
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เอกสาร/หลักฐานที่นำมา</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach (ReceiveDetailEvidence::find()->where(['receive_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                                <tr>
                                    <td><?= $no++ . ')  '; ?></td>
                                    <td><?= $row->evidencename->evidence; ?></td>
                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table> 
                    <hr/>
                    <table>
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เอกสาร/หลักฐานที่ไม่ครบ</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                                <tr>
                                    <td><?= $no++ . ')  '; ?></td>
                                    <td><?= $row->evidencenamenot->evidence; ?></td>
                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table>
                    <hr/>
                    <table>
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>ข้อกำหนดที่ไม่ครบ</td>                                
                            </tr>
                        </thead>        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (SurveyDetailType::find()->where(['store_at_id' => $model->receive_id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->typename->name;?></td> 
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table>                     
                    <hr/> 

                    <?php                    
                    $bb = SurveyDetailText::find()->where(['store_at_id' => $model->receive_id])->all();
                    ?>
                    <table> 
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เงื่อนไขการอนุญาต</td>                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($bb as $datas): ?>
                                <tr>
                                    <td><?= $i++ . ')'; ?></td>
                                    <td><?= $datas->name; ?></td>                            
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading"> บันทึกประกอบการออกใบอนุญาต</div>
        <div class="panel-body">
            <div class="row">

                <div class="col-md-6">                    
                    <?= $form->field($model, 'status')->inline()->radioList([2 => 'อนุญาต', 3 => 'ไม่อนุญาต', 4 => 'บันทึกผลตรวจแล้ว'])->label('ยืนยัน') ?>
                    <?=
                    $form->field($model, 'final_date_start')->widget(DateControl::classname(), [
                        'type' => DateControl::FORMAT_DATE,
                        'language' => 'th',
                        'widgetOptions' => [
                            'pluginOptions' => ['autoclose' => true],
                            'options' => ['placeholder' => '..วันที่ออกใบอนุญาต']
                        ]
                    ]);
                    ?>
                    <?=
                    $form->field($model, 'final_date_exp')->widget(DateControl::classname(), [
                        'type' => DateControl::FORMAT_DATE,
                        'language' => 'th',
                        'widgetOptions' => [
                            'pluginOptions' => ['autoclose' => true],
                            'options' => ['placeholder' => '..วันสิ้นอายุใบอนุญาต']
                        ]
                    ]);
                    ?>
                </div>  
                <div class="col-md-6">
                    <?= $form->field($model, 'service_fee')->textInput(['maxlength' => true]); ?> 
                    <?= $form->field($model, 'bill_book')->textInput(['maxlength' => true]); ?> 
                    <?=
                    $form->field($model, 'bill_date')->widget(DateControl::classname(), [
                        'type' => DateControl::FORMAT_DATE,
                        'language' => 'th',
                        'widgetOptions' => [
                            'pluginOptions' => ['autoclose' => true],
                            'options' => ['placeholder' => '..ลงวันที่ใบเสร็จ']
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>  



    <?= $form->field($model, 'store_own_dob')->hiddenInput(['maxlength' => true])->label(FALSE) ?>
    <?= $form->field($model, 'store_own_sex')->hiddenInput(['maxlength' => true])->label(FALSE) ?>
    <?php //echo $form->field($model, 'status')->textInput()  ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS
$.fn.modal.Constructor.prototype.enforceFocus = function() {};        
      

JS;
$this->registerJS($js);
?>