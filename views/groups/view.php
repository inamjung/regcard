<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */
?>
<div class="groups-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
