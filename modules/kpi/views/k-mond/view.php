<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\KMond */
?>
<div class="kmond-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kpi_mond',
        ],
    ]) ?>

</div>
