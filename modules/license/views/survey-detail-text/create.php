<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\license\models\SurveyDetailText */

?>
<div class="survey-detail-text-create">
    <?= $this->render('_form', [
        'model' => $model,
        'id'=>$id
    ]) ?>
</div>
