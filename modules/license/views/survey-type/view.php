<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\SurveyType */
?>
<div class="survey-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
        ],
    ]) ?>

</div>
