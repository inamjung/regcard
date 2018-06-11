<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;;
use yii\data\ActiveDataProvider;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">
<style>
.form-group {
  margin-bottom: 0px;
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
/*.col-sm-offset-1 {
    margin-left: 1%;
}*/
.modal.in .modal-dialog {
    width: 50%;
}
</style>
    <?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-md-3',         
            'wrapper' => 'col-md-8'
        ]
    ],
    'layout' => 'horizontal'
]);?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    

    <?php //echo $form->field($model, 'status')->textInput() ?>

    

    <?= $form->field($model, 'pname')->inline()->radioList(['นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_id')->widget(Select2::className(), ['data' => 
                    ArrayHelper::map(app\modules\kpi\models\Kpidepart::find()->orderBy('kpi_dep')->all(), 'id', 'kpi_dep'),
                        'options' => [ 
                        'placeholder' => 'หน่วยงาน..'],
                        'pluginOptions' => [
                            'allowClear' => true,],
                    ]);
            ?>

    <?= $form->field($model, 'occ_id')->widget(Select2::className(), ['data' => 
                    ArrayHelper::map(app\models\Occupations::find()->orderBy('name')->all(), 'id', 'name'),
                        'options' => [ 
                        'placeholder' => 'อาชีพ..'],
                        'pluginOptions' => [
                            'allowClear' => true,],
                    ]);
            ?>

    

    <?= $form->field($model, 'pos_id')->widget(Select2::className(), ['data' => 
                    ArrayHelper::map(app\models\Positions::find()->orderBy('name')->all(), 'id', 'name'),
                        'options' => [ 
                        'placeholder' => 'ตำแหน่ง..'],
                        'pluginOptions' => [
                            'allowClear' => true,],
                    ]);
            ?>

    <?= $form->field($model, 'pos_no')->textInput(['maxlength' => true]) ?>

    <?php if(Yii::$app->user->identity->role== \app\models\Users::ROLE_ADMIN) :?>
    <hr>
    <?= $form->field($model, 'role')->dropDownList(
            [1=>'admin',10=>'user',20=>'leader'],
            ['prompt'=>'ระดับเข้าใช้งาน']        
            ) ?>
    <?php endif; ?>
    
<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
