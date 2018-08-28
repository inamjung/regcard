<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\license\models\Cchangwat;
use app\modules\license\models\Campur;
use app\modules\license\models\Ctambon;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use app\modules\license\models\Village;
use app\modules\license\models\Cprename;
use app\modules\license\models\ProvisNation;
?>

<div class="person-form">

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
            width: 40%;
        }  
    </style>

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-md-2',
                        'wrapper' => 'col-md-9',
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>

    <?= $form->field($model, 'HID')->hiddenInput(['id' => 'HID', 'value' => $id])->label(false); ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true, 'id' => 'CID']) ?>


    <?=
    $form->field($model, 'PRENAME')->widget(select2::classname(), [
        'data' => ArrayHelper::map(Cprename::find()->all(), 'id', 'title_th'),
        'options' => ['id' => 'PRENAME'],
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => '--- คำนำหน้า ---',
        ],
    ]);
    ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true, 'id' => 'NAME']) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true, 'id' => 'LNAME']) ?>

    <?php
    $sex = ['1' => 'ชาย', '2' => 'หญิง'];

    echo $form->field($model, 'SEX')->widget(\kartik\widgets\Select2::className(), [
        'data' => $sex,
        'options' => [
            'placeholder' => 'เพศ', 'id' => 'SEX'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ])
    ?>

    <?=
    $form->field($model, 'BIRTH')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'language' => 'th',
        'ajaxConversion' => false,
        'options' => [
            'id' => 'BIRTH',
        ],
        'widgetOptions' => [
            'pluginOptions' =>
            [
                'autoclose' => true
            ]]
    ]);
    ?>

    <?=
    $form->field($model, 'NATION')->widget(select2::classname(), [
        'data' => ArrayHelper::map(ProvisNation::find()->all(), 'code', 'name'),
        'options' => ['id' => 'NATION'],
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => '--- สัญชาติ ---',
        ],
    ]);
    ?>

    <?= $form->field($model, 'PASSPORT')->textInput(['maxlength' => true, 'id' => 'PASSPORT']) ?>
    
     <?php // $form->field($model, 'TYPEAREA')->textInput(['maxlength' => true, 'id' => 'TYPEAREA']) ?>

   


    <div class="col-md-2">
        <div class="form-group" style="margin-top:25px;">
            <p class="btn btn-default glyphicon glyphicon-plus" id="person" title="เพิ่มสมาชิกในบ้าน"></p>
            <?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])   ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< JS
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};         
$(function(){
    showperson();
});
    $("#person").click(function(e){
        $.ajax({
            url:'index.php?r=license/home/add-person',
            type: 'post',
            datatype:'json',
            data: {HID:$('#HID').val(),CID:$('#CID').val(),PRENAME:$('#PRENAME').val(),
            NAME:$('#NAME').val(),LNAME:$('#LNAME').val(),SEX:$('#SEX').val(),BIRTH:$('#BIRTH').val(),
            NATION:$('#NATION').val(),PASSPORT:$('#PASSPORT').val(),TYPEAREA:$('#TYPEAREA').val()},
            success: function(data) {         
                $('#CID').val(''), 
                $('#PRENAME').val(''),
                $("#PRENAME").trigger('change'),
                $('#NAME').val(''),
                $('#LNAME').val(''),
                $('#SEX').val(''),
                $("#SEX").trigger('change'),
                $('#BIRTH').val(''),                 
                $('#NATION').val(''),
                $("#NATION").trigger('change'),
                $('#PASSPORT').val(''), 
                $('#TYPEAREA').val(''),
                $("#TYPEAREA").trigger('change');                    
               // $("#evidence_id").trigger('change');
            //    }
               // $.pjax.reload({container:"#pjax-items"});
               showperson();
            }
        });
        e.preventDefault();
});

function showperson(){
    $.ajax({
        url:'index.php?r=license/person',
        type:'get',
        data:{id:$('#HID').val()},
        success:function(data){
            $('#showperson').html(data);
        }

    });
}
JS;
$this->registerJS($js);
?>