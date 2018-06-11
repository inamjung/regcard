<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\KPan */
?>
<div class="kpan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kpi_pan',
        ],
    ]) ?>

</div>
