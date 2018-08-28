<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\modules\license\models\Evidence;
?>

<div class="receive-detail-evidence-not-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        
        <div class="col-md-10">
            <?= $form->field($model, 'receive_id')->hiddenInput(['id' => 'receive_id', 'value' => $id])->label(false); ?>

            <?=
            $form->field($model, 'evidence_id')->widget(select2::classname(), [
                'data' => ArrayHelper::map(Evidence::find()->all(), 'id', 'evidence'),
                'options' => ['id' => 'evidence1_id'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => '--- เอกสาร/หลักฐานที่ไม่ครบ ---',
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="margin-top:25px;">
                <p class="btn btn-default glyphicon glyphicon-plus" id="evidencenot" title="เพิ่มเอกสาร/หลักฐานที่ไม่ครบ"></p>
<?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])   ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};         
$(function(){
    showevidencenot();
});
    $("#evidencenot").click(function(e){
        $.ajax({
            url:'index.php?r=license/receive/add-evidence-not',
            type: 'post',
            datatype:'json',
            data: {receive_id:$('#receive_id').val(),evidence1_id:$('#evidence1_id').val()},
            success: function(data) {
            //    if(data == "success"){
              //  $('#vn').val(''),
                $('#evidence1_id').val(''),                
                $("#evidence1_id").trigger('change');
            //    }
               // $.pjax.reload({container:"#pjax-items"});
               showevidencenot();
            }
        });
        e.preventDefault();
});

function showevidencenot(){
    $.ajax({
        url:'index.php?r=license/receive-detail-evidence-not/indexnot/',
        type:'get',
        data:{id:$('#receive_id').val()},
        success:function(data){
            $('#showevidencenot').html(data);
        }

    });
}
JS;
$this->registerJS($js);
?>