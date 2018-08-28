<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="tb-year-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'y_year_long')->textInput(['maxlength' => true,'placeholder'=>'..เช่น 2561']) ?>

    <?= $form->field($model, 'y_year_short')->textInput(['maxlength' => true,'placeholder'=>'..เช่น 61']) ?>

    <?= $form->field($model, 'no_number')->textInput(['maxlength' => true,'placeholder'=>'..เช่น 610000']) ?>
    <?= $form->field($model, 'status')->radioList([1=>'เปิดใช้งาน',0=>'ปิดการใช้งาน']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
