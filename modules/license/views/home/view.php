<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Home */
?>
<div class="home-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'HOSPCODE',
//            'HID',
//            'HOUSE_ID',
//            'ROOMNO',
            'HOUSE',
//            'SOISUB',
//            'SOIMAIN',
//            'ROAD',
//            'VILLANAME',
            'VILLAGE',
            'TAMBON',
            'AMPUR',
            'CHANGWAT',
            'TELEPHONE',
            'LATITUDE',
            'LONGITUDE',
//            'OUTDATE',
//            'D_UPDATE',
//            'public_home_data_chunk_id_temp',
            'TYPEAREA',
        ],
    ]) ?>

</div>
