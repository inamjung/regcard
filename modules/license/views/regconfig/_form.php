<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\license\models\Thaiaddress;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
?>

<div class="regconfig-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>
    
    <?php
    $url = \yii\helpers\Url::to(['addr-list']);
    $addr = empty($model->addressid) ? '' : Thaiaddress::findOne($model->addressid)->full_name;
    echo $form->field($model, 'addressid')->widget(select2::classname(), [
        'initValueText' => $addr,
        'options' => ['id' => 'addressid'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'placeholder' => '--- เทศบาลอำเภอ ---',
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(addr) { return addr.text; }'),
            'templateSelection' => new JsExpression('function(addr) { return addr.text; }'),
        ],
    ]);
    ?> 

    <?= $form->field($model, 'addr_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'book_no')->textInput(['maxlength' => true]) ?>
    
    <hr/>
    <?= $form->field($model,'logo_img')->fileInput() ?>
    <?php if($model->logo){?>
      <?= Html::img('pictures/'.$model->logo,['class'=>'img-responsive','width'=>'200px;']);?>
    <?php
    }
    ?>


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