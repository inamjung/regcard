<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\license\models\Cchangwat;
use app\modules\license\models\Campur;
use app\modules\license\models\Ctambon;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use app\modules\license\models\Village;
use app\modules\license\models\Cprename;
use app\modules\license\models\ProvisNation;
?>

<div class="person-form">

    <style>
        .form-group {
            margin-bottom: 1px;
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
        .modal.in .modal-dialog {
            width: 40%;
        }  
    </style>
    

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-md-2',
                        'wrapper' => 'col-md-9',
                    ]
                ],
                'layout' => 'horizontal'
    ]);
    ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENAME')->widget(select2::classname(), [
                        'data' => ArrayHelper::map(Cprename::find()->all(), 'id', 'title_th'),
                        'options' => ['id' => 'PRENAME'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => '--- คำนำหน้า ---',
                        ],
                    ]);
                    ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true]) ?>

    <?php $sex = ['1'=>'ชาย','2'=>'หญิง'];
    
    echo $form->field($model, 'SEX')->widget(\kartik\widgets\Select2::className(),[
        'data'=> $sex,
        'options'=>[
            'placeholder'=>'เพศ'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'BIRTH')->widget(DateControl::classname(), [
                    'type' => DateControl::FORMAT_DATE,
                    'language' => 'th',                    
                    'ajaxConversion' => false,
                    'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
                ]);
                ?>

    <?= $form->field($model, 'NATION')->widget(select2::classname(), [
                        'data' => ArrayHelper::map(ProvisNation::find()->all(), 'code', 'name'),
                        'options' => ['id' => 'NATION'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => '--- สัญชาติ ---',
                        ],
                    ]);
                    ?>
 
    <?= $form->field($model, 'PASSPORT')->textInput(['maxlength' => true]) ?>

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