<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpiyear */
?>
<div class="kpiyear-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kpiyear',
            'd_begin',
            'd_end',
            'range',
        ],
    ]) ?>

</div>
