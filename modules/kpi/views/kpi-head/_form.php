<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\KpiHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-head-form">
    
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
            width: 69%;
        }
        .from-box{
            display: inline-block;
            width: 400px;
            height: 30px;
            /* margin: 10px; */
            /* border: 3px solid #73AD21;  */
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

    <?= $form->field($model, 'mond_id')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(app\modules\kpi\models\KMond::find()->all(), 'id', 'kpi_mond'),
        'options'=>[
            'placeholder'=>'..เลือกหมวด...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'pan_id')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(app\modules\kpi\models\KPan::find()->all(), 'id', 'kpi_pan'),
        'options'=>[
            'placeholder'=>'..เลือกแผน...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'kong_id')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(\app\modules\kpi\models\KKong::find()->all(), 'id', 'kpi_kong'),
        'options'=>[
            'placeholder'=>'..เลือกโครงการ...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'level_id')->inline()->checkboxList(ArrayHelper::map(app\modules\kpi\models\KLevel::find()
                                                ->all(), 'id', 'kpi_pon_level'));?>

    <?= $form->field($model, 'name_h')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'kpitype_id')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(app\modules\kpi\models\Kpitype::find()->all(), 'id', 'kpitype'),
        'options'=>[
            'placeholder'=>'..เลือกลักษณะ...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'kpidesc')->textarea(['rows' => 12]) ?>

    <?= $form->field($model, 'perfomance')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'target')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'fomula')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpiyear')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(app\modules\kpi\models\Kpiyear::find()->all(), 'kpiyear', 'kpiyear'),
        'options'=>[
            'placeholder'=>'..เลือกปีงบประมาณ...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'kpidepart_id')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpidepart::find()->all(), 'id', 'kpi_dep'),
        'options'=>[
            'placeholder'=>'..เลือกหน่วยงานรับผิดชอบ...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'user_kpi_h')->textInput(['maxlength' => true,'placeHolder'=>'ระบุชื่อผู้รับผิดชอบ']) ?>

    <?= $form->field($model, 'statuskpi')->widget(\kartik\checkbox\CheckboxX::className(),[
        'pluginOptions'=>[
            'threeState'=>FALSE
        ]
    ])->label('ใช้งานตัวชี้วัดนี้หรือไม่?') ?>


    <?php // $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>


  
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