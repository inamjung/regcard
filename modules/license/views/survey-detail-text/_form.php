<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="survey-detail-text-form">

    <?php $form = ActiveForm::begin(['id' => 'myfromtext', 'action' => ['/license/survey-detail-text/create']]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'store_at_id')->hiddenInput(['id' => 'store_at_id', 'value' => $id])->label(false); ?>

            <?= $form->field($model, 'name')->textInput(['id' => 'name','maxlength' => true,'placeholder'=>'ระบุเงื่อนไข..']) ?>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="margin-top:25px;">
                <p class="btn btn-default glyphicon glyphicon-plus" id="testtext" title="เพิ่มเงื่อนไข"></p>
                <?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])   ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS
      
$(function(){
    showtext();
});
    $("#testtext").click(function(e){
        $.ajax({
            url:'index.php?r=license/store-at/add-text',
            type: 'post',
            datatype:'json',
            data: {store_at_id:$('#store_at_id').val(),name:$('#name').val()},
            success: function(data) {
            //    if(data == "success"){              
                $('#name').val(''),                
            //    $("#type_id").trigger('change');
            //    }
               // $.pjax.reload({container:"#pjax-items"});
               showtext();
            }
        });
        e.preventDefault();
});

function showtext(){
    $.ajax({
        url:'index.php?r=license/survey-detail-text',
        type:'get',
        data:{id:$('#store_at_id').val()},
        success:function(data){
            $('#showtext').html(data);
        }

    });
}
JS;
$this->registerJS($js);
?>