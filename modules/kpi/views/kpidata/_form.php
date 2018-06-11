<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpidata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kpi_id')->textInput() ?>

    <?= $form->field($model, 'frequency_no')->textInput() ?>

    <?= $form->field($model, 'd_end_result')->textInput() ?>

    <?= $form->field($model, 'denom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denom_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id_result')->textInput() ?>

    <?= $form->field($model, 'd_add')->textInput() ?>

    <?= $form->field($model, 'd_edit')->textInput() ?>

    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'qty_kan')->textInput() ?>

    <?= $form->field($model, 'kan')->textInput() ?>

    <?= $form->field($model, 'kpilist_id')->textInput() ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
