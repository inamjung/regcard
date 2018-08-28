<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="village-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'VID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?php $bantype = ['1'=>'ในเขตเทศบาล','0'=>'นอกเขตเทศบาล'];
    
    echo $form->field($model, 'TYPEAREA')->widget(\kartik\widgets\Select2::className(),[
        'data'=> $bantype,
        'options'=>[
            'placeholder'=>'ใน/นอก เขตเทศบาล'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?php // $form->field($model, 'D_UPDATE')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
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