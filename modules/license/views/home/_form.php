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
use app\modules\license\models\Home;
use app\modules\license\models\Person;



$maxhid =  Home::find()->max("HID");
$uphid= $maxhid + 1;
?>

<div class="home-form">

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
            width: 70%;
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
    <?= $form->field($model, 'HID')->hiddenInput(['maxlength' => true,'value'=>$uphid])->label(false) ?>

    <?= $form->field($model, 'HOUSE')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'VILLAGE')->widget(kartik\widgets\Select2::className(), [
        'data' => ArrayHelper::map(Village::find()->all(), 'id', 'NAME'),
        'options' => ['id' => 'village'],
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => '--- หมู่บ้าน ---',
        ],
    ]);
    ?>


    <?=
    $form->field($model, 'CHANGWAT')->widget(kartik\widgets\Select2::className(), [
        'data' => ArrayHelper::map(Cchangwat::find()->all(), 'changwatcode', 'changwatname'),
        'options' => ['id' => 'ddl-province'],
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => '--- จังหวัด ---',
        ],
    ]);
    ?>
    <?=
    $form->field($model, 'AMPUR')->widget(DepDrop::className(), [
        'data' => $amphur,
        'options' => ['placeholder' => '<--อำเภอ-->', 'id' => 'ddl-amphur'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['ddl-province'],
            'url' => yii\helpers\Url::to(['/license/home/get-amphur']),
            'loadingText' => 'Loading1...',
        ],
    ]);
    ?>
    <?=
    $form->field($model, 'TAMBON')->widget(DepDrop::className(), [
        'data' => $district,
        'options' => ['placeholder' => '<--ตำบล-->',
        //'disabled'=>true, 
        ],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['ddl-province', 'ddl-amphur'],
            'url' => yii\helpers\Url::to(['/license/home/get-district']),
            'loadingText' => 'Loading2...',
        ],
    ]);
    ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'LATITUDE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LONGITUDE')->textInput(['maxlength' => true]) ?>



    <?php
    $bantype = ['1' => 'ในเขตเทศบาล', '0' => 'นอกเขตเทศบาล'];

    echo $form->field($model, 'TYPEAREA')->widget(\kartik\widgets\Select2::className(), [
        'data' => $bantype,
        'options' => [
            'placeholder' => 'ใน/นอก เขตเทศบาล'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ])
    ?>
    
    <div class="panel panel-info" style="display: none">
        <div class="panel-heading"> เพิ่มสมาชิกในบ้าน</div>
        <div class="panel-body">
           
            <div class="row">

                <div class="col-md-12">                    
                        <?php
                        echo $this->render('@app/modules/license/views/person/create', [
                            'model' => new Person(),
                            'id' => $model->HID
                        ]);
                        ?>
                        <div id="showperson"></div>

                </div>
               
            </div>
        </div>
    </div>


    <?php if (!Yii::$app->request->isAjax) { ?>
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