<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\SurveyDetailType */
?>
<div class="survey-detail-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'store_at_id',
            'type_id',
        ],
    ]) ?>

</div>
