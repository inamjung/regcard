<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\ReceiveDetailEvidence */
?>
<div class="receive-detail-evidence-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'receive_id',
            'evidence_id',
        ],
    ]) ?>

</div>
