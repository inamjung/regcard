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
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
use app\modules\license\models\StoreType;

$c = \app\modules\license\models\Receive::find()->count();
$count = $c+1;
$tbyear = TbYearNumber::find()->where(['status' => 1])->one()->no_number;
//$notbyear = $tbyear->no_number;
$okno = $tbyear.'/'.$count;

?>

<div class="receive-form">
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


    <div class="panel panel-info">
        <div class="panel-heading"> ข้อมูลคำขอ
            <?php echo Html::button('<i class="glyphicon glyphicon-download"></i> นำเข้าข้อมูลบัตรประชาชน', ['class' => 'btn btn-default', 'type' => "", 'onClick' => 'return loadSmartCard();']); ?>
            
            <?php //echo Html::button('<i class="glyphicon glyphicon-download"></i> นำเข้าข้อมูลพื้นที่ตั้งร้าน', ['class' => 'btn btn-default', 'type' => "", 'onClick' => 'return loadPersonHome();']); ?>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">                    
                       <?=
                    $form->field($model, 'code_no')->textInput(['readonly' => true,                       
                     'value' => $okno])->label('เลขที่')
                    ?>
                    <?= $form->field($model, 'place_request')->textInput(['maxlength' => true, 'placeholder' => 'ระบุสถานที่ หากไม่ได้เขียนที่สำนักงานเทศบาล..']) ?>
                    <?=
                    $form->field($model, 'date_request')->widget(DateControl::classname(), [
                        'type' => DateControl::FORMAT_DATE,
                        'language' => 'th',
                        //'disabled'=> $model->rm_approve == 1,
                        'ajaxConversion' => false,
                        'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
                    ]);
                    ?>
                    <?php
                    $liste = ['1' => 'ขอรับ/ต่ออายุใบอนุญาต', '2' => 'ขอจัดตั้งสถานที่'];
                    echo $form->field($model, 'store_type')->widget(select2::classname(), [
                        'data' => $liste,
                        'options' => ['id' => 'store_type'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => '--- ประเภทแบบคำขอ ---',
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'store_type_id')->widget(select2::classname(), [
                        'data' => ArrayHelper::map(StoreType::find()->all(), 'id', 'name'),
                        'options' => ['id' => 'store_type_id'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => '--- ประเภทของกิจการ ---',
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'store_area')->textInput(['maxlength' => true, 'placeholder' => 'ระบุจำนวนพื้นที่ตั้งกิจการเป็นหน่วยตารางเมตร..'])->label('พื้นที่ตั้ง(ตร.เมตร)') ?>

<!--        <ที่ตั้งร้าน        -->
<div style="display: none">
    <?= $form->field($model, 'store_addr')->textInput(['maxlength' => true]) ?>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-5">
                            <?= $form->field($model, 'store_moo')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'store_tmb')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-5">
                            <?= $form->field($model, 'store_amp')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'store_chw')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
</div>
                    

<!--        ที่ตั้งร้าน>        -->    

                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'store_own_cid')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;']) ?>
                    <div class="row">
                        <div class="col-sm-2" style="display: none">
                            <?= $form->field($model, 'store_own_pname')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;'])?>
                        </div>
                        <div class="col-sm-offset-2 col-sm-4">
                            <?= $form->field($model, 'store_own_fname')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;'])->label(FALSE)?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'store_own_lname')->textInput(['maxlength' => true, 'style' => 'background-color: #cdd7c99c;'])->label(FALSE)?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'store_own_age')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;'])->label(FALSE)?>
                        </div>
                    </div> 
                                        
                    <?= $form->field($model, 'store_own_addr')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;']) ?>                     
                    <?= $form->field($model, 'store_own_moo')->textInput(['maxlength' => true, 'style' => 'background-color: #cdd7c99c;'])?>
                    <?= $form->field($model, 'store_own_tmb')->textInput(['maxlength' => true, 'style' => 'background-color: #cdd7c99c;'])?>
                    <?= $form->field($model, 'store_own_amp')->textInput(['maxlength' => true, 'style' => 'background-color: #cdd7c99c;'])?>
                    <?= $form->field($model, 'store_own_chw')->textInput(['maxlength' => true,'style' => 'background-color: #cdd7c99c;'])?>
                    
                    <?php
                    $url = \yii\helpers\Url::to(['nation-list']);
                    $nation = empty($model->store_own_nation) ? '' : ProvisNation::findOne($model->store_own_nation)->name; //กำหนดค่าเริ่มต้น
                    echo $form->field($model, 'store_own_nation')->widget(select2::classname(), [
                        'initValueText' => $nation,
                        'options' => ['id' => 'store_own_nation'],
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
                                'options' => ['class' => 'form-control'],]);
                    ?>          

                </div>       
            </div>
        </div>
    </div>   



    <div class="panel panel-info" style="display: none">
        <div class="panel-heading"> เอกสาร/หลักฐาน</div>
        <div class="panel-body">
            <div class="row">
                <?=
                    $form->field($model, 'evidence_complete')->inline()->radioList([
                        '1' => 'ครบ', '2' => 'ไม่ครบ คือ'
                    ])
                    ?>
            </div>
            <hr/>
            <div class="row">

                <div class="col-md-5">
                    <div class="row">
                        <?php
                        echo $this->render('@app/modules/license/views/receive-detail-evidence/create', [
                            'model' => new ReceiveDetailEvidence(),
                            'id' => $model->id
                        ]);
                        ?>
                        <div id="showevidence"></div>
                    </div>
                </div>
                <div class="col-sm-offset-1 col-md-5">
                    
                    <div class="row">
                        <?php
                        echo $this->render('@app/modules/license/views/receive-detail-evidence-not/create', [
                            'model' => new ReceiveDetailEvidenceNot(),
                            'id' => $model->id
                        ]);
                        ?>
                        <div id="showevidencenot"></div>
                    </div>
                </div>
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