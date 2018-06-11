<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpidata-form">

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
            width: 60%;
        }
    </style>
    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-md-3',
                        'wrapper' => 'col-md-8'
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>

    <?php //echo $form->field($model, 'kpi_id')->textInput() ?>

    <?= $form->field($model, 'frequency_no')->textInput() ?>

    <?= $form->field($model, 'd_end_result')->widget(DateControl::classname(), [
                        'type' => DateControl::FORMAT_DATE,
                        'ajaxConversion' => false,
                        'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
                    ]);
                    ?>

    <?= $form->field($model, 'denom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devide')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_text')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
                            'options' => [
                                //'accept' => 'image/*',
                                'multiple' => true
                                ],
                            'pluginOptions' => [
                                'initialPreview'=>$model->initialPreview($model->docs,'docs','file'),
                                'initialPreviewConfig'=>$model->initialPreview($model->docs,'docs','config'),
                                'allowedFileExtensions'=>['jpg','png','pdf','doc','docx','xls','xlsx'],
                                'showPreview' => false,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false,
                                'overwriteInitial'=>false
                             ]
                            ]); 
                        ?>   

    <?= $form->field($model, 'goal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>

    <?php //echo $form->field($model, 'devide_c')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'denom_c')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'calc')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'user_id_result')->textInput() ?>

    <?php //echo $form->field($model, 'd_add')->textInput() ?>

    <?php //echo $form->field($model, 'd_edit')->textInput() ?>    
    
    <?php //echo $form->field($model, 'qty_kan')->textInput() ?>

    <?php //echo $form->field($model, 'kan')->textInput() ?>

    <?php //echo $form->field($model, 'kpilist_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
