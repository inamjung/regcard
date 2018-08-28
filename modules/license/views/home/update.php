<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Home */
?>
<div class="home-update">

    <?=
    $this->render('_formupdate', [
        'model' => $model,
        'amphur' => $amphur,
        'district' => $district
    ])
    ?>

</div>
