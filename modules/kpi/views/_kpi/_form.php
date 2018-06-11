<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-form">

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

    <?= $form->field($model, 'kpiname')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'kpidesc')->textarea(['rows' => 3]) ?>

    <?=
    $form->field($model, 'kpitype_id')->widget(kartik\widgets\Select2::className(), [
        'data' => yii\helpers\ArrayHelper::map(app\modules\kpi\models\Kpitype::find()->all(), 'id', 'kpitype'),
        'options' => [
            'placeholder' => 'ระบุประเภทของตัวชี้วัด..'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'kpiyear',['labelOptions' => ['style' => 'color: red']])->widget(kartik\widgets\Select2::className(), [
        'data' => yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpiyear::find()->all(), 'kpiyear', 'kpiyear'),
        'options' => [
            'placeholder' => 'ระบุปีงบประมาณ..'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'd_begin_year',['labelOptions' => ['style' => 'color: red']])->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'ajaxConversion' => false,
        'widgetOptions' => ['pluginOptions' => ['autoclose' => true]]
    ]);
    ?>
    <?=
    $form->field($model, 'period_id',['labelOptions' => ['style' => 'color: red']])->widget(kartik\widgets\Select2::className(), [
        'data' => yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpiperiod::find()->all(), 'id', function($model, $defaultValue) {
                    return $model->period . ' ครั้ง/ปี : ' . $model->description;
                }),
        'options' => [
            'placeholder' => 'ความถี่การรายงานผล..',
            'required' => ''
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>
    <?php
    $datas = ['<=' => '<= (น้อยกว่าหรือเท่ากับ)', '>=' => '>= (มากกว่าหรือเท่ากับ)'];
    ?>
    <?=
    $form->field($model, 'operation',['labelOptions' => ['style' => 'color: red']])->widget(Select2::classname(), [
        'data' => $datas,
        'language' => 'th',
        'options' => ['placeholder' => 'ค่าดัชนีที่ใช้ ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
            ]
    )
    ?>
    <?= $form->field($model, 'goal',['labelOptions' => ['style' => 'color: red']])->label('ผลลัพธ์ที่กำหนดผ่านเกณฑ์')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'goal_des')->label('ที่มาของผลลัพธ์')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'target_des')->label('ที่มาของเป้าหมาย')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'critiria_value')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'sourcekpi')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'kpidepart_id',['labelOptions' => ['style' => 'color: red']])->widget(kartik\widgets\Select2::className(), [
        'data' => yii\helpers\ArrayHelper::map(\app\modules\kpi\models\Kpidepart::find()->all(), 'id', 'kpi_dep'
                . ''),
        'options' => [
            'placeholder' => 'หน่วยงานรับผิดชอบ..'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'user_kpi')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'statuskpi')->widget(CheckboxX::classname(), [
        'pluginOptions' => ['threeState' => false],
    ])->label('ใช้ตัวชี้วัด');
    ?>
    <hr>
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


    <?php //echo $form->field($model, 'denom')->textInput(['maxlength' => true])  ?>

    <?php //echo $form->field($model, 'devide')->textInput(['maxlength' => true])  ?>

    <?php //echo $form->field($model, 'goal_des')->textarea(['rows' => 6])  ?>

    <?php //echo $form->field($model, 'target')->textInput(['maxlength' => true])  ?>

    <?php //echo $form->field($model, 'denom_c')->textInput(['maxlength' => true])  ?>

    <?php //echo $form->field($model, 'denom_c_unit')->textInput(['maxlength' => true])  ?>

    <?php //echo $form->field($model, 'divide_c')->textInput(['maxlength' => true])  ?>

<?php //echo $form->field($model, 'devide_c_unit')->textInput(['maxlength' => true])  ?>


    <?php //echo $form->field($model, 'useradd_id')->textInput()   ?>

    <?php //echo $form->field($model, 'd_add')->textInput()   ?>

    <?php //echo $form->field($model, 'useredit_id')->textInput()   ?>

    <?php //echo $form->field($model, 'd_edit')->textInput()   ?>

 <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>


        <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

<?php ActiveForm::end(); ?>

</div>
