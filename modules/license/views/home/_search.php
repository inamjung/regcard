<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\HomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'HID') ?>

    <?= $form->field($model, 'HOUSE_ID') ?>

    <?= $form->field($model, 'ROOMNO') ?>

    <?php // echo $form->field($model, 'HOUSE') ?>

    <?php // echo $form->field($model, 'SOISUB') ?>

    <?php // echo $form->field($model, 'SOIMAIN') ?>

    <?php // echo $form->field($model, 'ROAD') ?>

    <?php // echo $form->field($model, 'VILLANAME') ?>

    <?php // echo $form->field($model, 'VILLAGE') ?>

    <?php // echo $form->field($model, 'TAMBON') ?>

    <?php // echo $form->field($model, 'AMPUR') ?>

    <?php // echo $form->field($model, 'CHANGWAT') ?>

    <?php // echo $form->field($model, 'TELEPHONE') ?>

    <?php // echo $form->field($model, 'LATITUDE') ?>

    <?php // echo $form->field($model, 'LONGITUDE') ?>

    <?php // echo $form->field($model, 'OUTDATE') ?>

    <?php // echo $form->field($model, 'D_UPDATE') ?>

    <?php // echo $form->field($model, 'public_home_data_chunk_id_temp') ?>

    <?php // echo $form->field($model, 'TYPEAREA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
