<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidata */
?>
<div class="kpidata-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kpi_id',
            'frequency_no',
            'd_end_result',
            'denom',
            'devide',
            'devide_c',
            'denom_c',
            'result',
            'result_text',
            'calc',
            'user_id_result',
            'd_add',
            'd_edit',
            'docs',
            'goal',
            'target',
            'target_des:ntext',
            'qty_kan',
            'kan',
            'kpilist_id',
            'ref',
        ],
    ]) ?>

</div>
