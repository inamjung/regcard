<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kpi_h_id')->textInput() ?>

    <?= $form->field($model, 'kpiname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpiyear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'period_id')->textInput() ?>

    <?= $form->field($model, 'd_begin_year')->textInput() ?>

    <?= $form->field($model, 'goal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal_des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'denom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denom_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'denom_c_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide_c_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'critiria_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kpidepart_id')->textInput() ?>

    <?= $form->field($model, 'user_kpi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statuskpi')->textInput() ?>

    <?= $form->field($model, 'user_result_id')->textInput() ?>

    <?= $form->field($model, 'd_add')->textInput() ?>

    <?= $form->field($model, 'user_edit_result_id')->textInput() ?>

    <?= $form->field($model, 'update_d')->textInput() ?>

    <?= $form->field($model, 'operation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
