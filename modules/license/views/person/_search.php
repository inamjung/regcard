<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'CID') ?>

    <?= $form->field($model, 'PID') ?>

    <?= $form->field($model, 'HID') ?>

    <?php // echo $form->field($model, 'PRENAME') ?>

    <?php // echo $form->field($model, 'NAME') ?>

    <?php // echo $form->field($model, 'LNAME') ?>

    <?php // echo $form->field($model, 'SEX') ?>

    <?php // echo $form->field($model, 'BIRTH') ?>

    <?php // echo $form->field($model, 'MSTATUS') ?>

    <?php // echo $form->field($model, 'OCCUPATION') ?>

    <?php // echo $form->field($model, 'RACE') ?>

    <?php // echo $form->field($model, 'NATION') ?>

    <?php // echo $form->field($model, 'RELIGION') ?>

    <?php // echo $form->field($model, 'EDUCATION') ?>

    <?php // echo $form->field($model, 'MOVEIN') ?>

    <?php // echo $form->field($model, 'DISCHARGE') ?>

    <?php // echo $form->field($model, 'DDISCHARGE') ?>

    <?php // echo $form->field($model, 'ABOGROUP') ?>

    <?php // echo $form->field($model, 'RHGROUP') ?>

    <?php // echo $form->field($model, 'LABOR') ?>

    <?php // echo $form->field($model, 'PASSPORT') ?>

    <?php // echo $form->field($model, 'TYPEAREA') ?>

    <?php // echo $form->field($model, 'D_UPDATE') ?>

    <?php // echo $form->field($model, 'public_person_data_chunk_id_temp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
