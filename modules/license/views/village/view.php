<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Village */
?>
<div class="village-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'HOSPCODE',
            //'VID',
            'NAME',
            [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'TYPEAREA',
        'value'=> function($model){
            if($model->TYPEAREA != '' and $model->TYPEAREA == '1' or $model->TYPEAREA == '' or $model->TYPEAREA == '3'){
                return 'ในเขตเทศบาล';
            }elseif ($model->TYPEAREA != '' and $model->TYPEAREA == '0' or $model->TYPEAREA == '4' or $model->TYPEAREA == '5') {
                return 'นอกเขตเทศบาล';
            } else {
                return '';
            }
        }
    ],
            //'D_UPDATE',
        ],
    ]) ?>

</div>
