<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpiperiod */
/* @var $form yii\widgets\ActiveForm */
?>
<style media="screen">
        .form-group {
            margin-bottom: 0px;
        }
        .help-block {
            display: block;
            margin-top: 2px;
            margin-bottom: 2px;
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
        .from-box{
            display: inline-block;
            width: 400px;
            height: 30px;
            /* margin: 10px; */
            /* border: 3px solid #73AD21;  */
        }
    </style>

<div class="kpiperiod-form">
    

    <?php
    $form = ActiveForm::begin([               
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-md-3',
                        'wrapper' => 'col-md-8'
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'd_total')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
