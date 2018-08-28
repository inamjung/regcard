<?php

use yii\widgets\DetailView;
use app\modules\license\models\Thaiaddress;
use yii\helpers\Html;

?>
<div class="regconfig-view">
    <div class="text-center">
        <?= Html::img('pictures/'.$model->logo,['class'=>'thumbnail img-responsive','width'=>180])?>
    </div>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'addressid',
                'value' => function($model) {
                    $address = Thaiaddress::find()->where(['addressid' => $model->addressid])->one();
                    if ($model->addressid != '') {
                        return $address->full_name;
                    } else {
                        return '';
                    }
                }
            ],
            'addr_text',
            'book_no',        
            'tel',
        ],
    ])
    ?>

</div>
