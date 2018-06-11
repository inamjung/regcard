<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\KpiHead */
?>
<div class="kpi-head-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mond_id',
            'pan_id',
            'kong_id',
            'level_id',
            'name_h',
            'kpitype_id',
            'kpidesc:ntext',
            'perfomance:ntext',
            'target:ntext',
            'fomula:ntext',
            'source',
            'kpiyear',
            'kpidepart_id',
            'user_kpi_h',
            'statuskpi',
            'user_id',
            'docs',
            'ref',
            'create_d',
            'upadte_d',
        ],
    ]) ?>

</div>
