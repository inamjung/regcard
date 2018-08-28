<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\ReceiveDetailEvidenceNot */
?>
<div class="receive-detail-evidence-not-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'receive_id',
            'evidence_id',
        ],
    ]) ?>

</div>
