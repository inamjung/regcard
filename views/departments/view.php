<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
?>
<div class="departments-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'group_id',
        ],
    ]) ?>

</div>
