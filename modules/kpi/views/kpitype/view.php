<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpitype */
?>
<div class="kpitype-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kpitype',
        ],
    ]) ?>

</div>
