<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\license\models\SurveyType;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
?>

<div class="survey-detail-type-form">


    <?php $form = ActiveForm::begin(['id' => 'myfrom', 'action' => ['/license/survey-detail-type/create']]); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'store_at_id')->hiddenInput(['id' => 'store_at_id', 'value' => $id])->label(false); ?>

            <?=
            $form->field($model, 'type_id')->widget(select2::classname(), [
                'data' => ArrayHelper::map(SurveyType::find()->all(), 'id', 'name'),
                'options' => ['id' => 'type_id'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => '--- ข้อกำหนด ---',
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="margin-top:25px;">
                <p class="btn btn-default glyphicon glyphicon-plus" id="test" title="เพิ่มข้อกำหนดที่ไม่ครบ"></p>
                <?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])  ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};         
$(function(){
    show();
});
    $("#test").click(function(e){
        $.ajax({
            url:'index.php?r=license/store-at/add-items',
            type: 'post',
            datatype:'json',
            data: {store_at_id:$('#store_at_id').val(),type_id:$('#type_id').val()},
            success: function(data) {
            //    if(data == "success"){
              //  $('#vn').val(''),
                $('#type_id').val(''),                
                $("#type_id").trigger('change');
            //    }
               // $.pjax.reload({container:"#pjax-items"});
               show();
            }
        });
        e.preventDefault();
});

function show(){
    $.ajax({
        url:'index.php?r=license/survey-detail-type',
        type:'get',
        data:{id:$('#store_at_id').val()},
        success:function(data){
            $('#show').html(data);
        }

    });
}
JS;
$this->registerJS($js);
?>