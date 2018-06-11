<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpi */
?>
<div class="kpi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kpi_h_id',
            'kpiname',
            'kpiyear',
            'period_id',
            'd_begin_year',
            'goal',
            'goal_des:ntext',
            'denom',
            'denom_c',
            'denom_c_unit',
            'devide',
            'devide_c',
            'devide_c_unit',
            'target',
            'target_des:ntext',
            'critiria_value:ntext',
            'kpidepart_id',
            'user_kpi',
            'statuskpi',
            'user_result_id',
            'd_add',
            'user_edit_result_id',
            'update_d',
            'operation',
            'formula',
            'docs',
            'ref',
        ],
    ]) ?>

</div>
