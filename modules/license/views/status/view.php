<?php

use yii\widgets\DetailView;

?>
<div class="status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'status',
        ],
    ]) ?>

</div>
