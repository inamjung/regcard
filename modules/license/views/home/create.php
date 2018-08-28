<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Home */

?>
<div class="home-create">
    <?= $this->render('_form', [
        'model' => $model,
        'amphur'=> [],
        'district' =>[],
    ]) ?>
</div>
