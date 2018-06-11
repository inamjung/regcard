<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\KpiHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-head-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mond_id')->textInput() ?>

    <?= $form->field($model, 'pan_id')->textInput() ?>

    <?= $form->field($model, 'kong_id')->textInput() ?>

    <?= $form->field($model, 'level_id')->textInput() ?>

    <?= $form->field($model, 'name_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpitype_id')->textInput() ?>

    <?= $form->field($model, 'kpidesc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'perfomance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'target')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fomula')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpiyear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpidepart_id')->textInput() ?>

    <?= $form->field($model, 'user_kpi_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statuskpi')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_d')->textInput() ?>

    <?= $form->field($model, 'upadte_d')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
