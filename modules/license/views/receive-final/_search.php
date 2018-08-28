<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\modules\license\models\StoreType;
use app\modules\license\models\Status;
use app\modules\license\models\Village;
?>

<div class="receive-final-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['data-pjax' => true]
    ]);
    ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'store_own_fname') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'store_own_lname') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->widget(select2::classname(), [
            'data'=> ArrayHelper::map(Status::find()->orderBy('id')->all(),'id','status'),
            'options' => [
              'id' => 'status','placeholder' => 'เลือก..',],
              'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,              
                ]]);
              ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'store_type_id')->widget(select2::classname(), [
            'data'=> ArrayHelper::map(StoreType::find()->orderBy('name')->all(),'id','name'),
            'options' => [
              'id' => 'store_type_id','placeholder' => 'เลือก..',],
              'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,              
                ]]);
              ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'store_moo')->widget(select2::classname(), [
            'data'=> ArrayHelper::map(Village::find()->orderBy('id')->all(),'id','NAME'),
            'options' => [
              'id' => 'store_moo','placeholder' => 'เลือก..',],
              'pluginOptions' => [
                'allowClear' => true,
                //'multiple' => true,              
                ]]);
              ?>
        </div>
    </div> 

    <div class="form-group" style="margin-top:25px;">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-refresh" aria-hidden="true"></i> คืนค่า', [''], ['class' => 'btn btn-default']); ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>