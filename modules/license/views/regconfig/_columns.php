<?php

use yii\helpers\Url;
use app\modules\license\models\Thaiaddress;
use yii\helpers\Html;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'attribute' => 'logo',
        'format' => 'html',
        'value' => function($model) {
            return Html::img('pictures/' . $model->logo, ['class' => 'thumbnail', 'width' => 180, 'alt' => $model->logo]);
        }
    ],
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
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'addr_text',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'book_no',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tel',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '180px;',
        'template' => '{view} {update}',
        'buttons' => [
            'view' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-search"></i>', $url
                                , ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
            },
            'update' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-edit"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไข']);
            },
//            'delete' => function($url, $model, $key) {
//                return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
//                            'title' => Yii::t('yii', 'Delete'),
//                            'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                            'data-method' => 'post',
//                            'data-pjax' => '0',
//                            'class' => 'btn btn-default'
//                ]);
//            }
        ]
    ],
];
