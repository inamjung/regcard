<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidepart */
?>
<div class="kpidepart-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'kpi_dep',
        ],
    ]) ?>

</div>
