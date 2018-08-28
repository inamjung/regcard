<?php

use yii\widgets\DetailView;


?>
<div class="evidence-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'evidence',
        ],
    ]) ?>

</div>
