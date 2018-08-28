<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\SurveyDetailText */
?>
<div class="survey-detail-text-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'store_at_id',
            'name',
        ],
    ]) ?>

</div>
