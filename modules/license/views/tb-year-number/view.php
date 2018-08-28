<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\TbYearNumber */
?>
<div class="tb-year-number-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'y_year_long',
            'y_year_short',
            'no_number',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model) {
                    if ($model->status == 1) {
                        return '<li style="color: green" class="glyphicon glyphicon-ok"></li> เปิดใช้งาน';
                    } elseif ($model->status == 0) {
                        return 'ปิดการใช้งาน';
                    } else {
                        return '';
                    }
                }
            ],
        ],
    ])
    ?>

</div>
