<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Person */

?>
<div class="person-create">
    <?= $this->render('_form', [
        'model' => $model,
        'id'=>$id
    ]) ?>
</div>
