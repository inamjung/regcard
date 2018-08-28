<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\modules\license\models\Person;
?>

<div class="receive-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['indexperson'],
                'method' => 'get',
                'options' => ['data-pjax' => true]
    ]);
    ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'fullName') ?>
        </div>
        
    </div> 

    <div class="form-group" style="margin-top:25px;">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-refresh" aria-hidden="true"></i> คืนค่า', [''], ['class' => 'btn btn-default']); ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
