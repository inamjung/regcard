<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpiperiod */
?>
<div class="kpiperiod-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'period',
            'd_total',
            'description',
        ],
    ]) ?>

</div>
