<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\license\models\StoreType;

$datalist = ['1' => 'ขอรับ/ต่ออายุใบอนุญาต', '2' => 'ขอจัดตั้งสถานที่'];

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'เลขที่',
        'attribute' => 'code_no',
        'width' => '120px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_own_pname',
        'header' => 'ชื่อเจ้าของกิจการ',
        'value' => function($model) {
            if ($model->store_own_fname != '') {
                return $model->store_own_fname . '  ' . $model->store_own_lname;
            } else {
                return '';
            }
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_type',
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => $datalist,
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => '<สถานะ>'],
        'value' => function($model) {
            if ($model->store_type != '') {
                if ($model->store_type == '1') {
                    return 'ขอรับ/ต่ออายุใบอนุญาต';
                } elseif ($model->store_type == '2') {
                    return 'ขอจัดตั้งสถานที่';
                } else {
                    return '';
                }
            }
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_type_id',
        'format' => 'raw',
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => ArrayHelper::map(app\modules\license\models\StoreType::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => '<ประเภทกิจการ>'],
        'value' => function($model) {
            $models = StoreType::find()->where(['id' => $model->store_type_id])->one();
            if ($model->store_type_id != '') {
                return $models->name;
            } else {
                return '';
            }
        }
//       'filter'=>false 
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_name',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_addr',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_moo',
        'header' => 'หมู่ที่',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'store_area',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'format' => 'raw',
        'attribute' => 'status',
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => ArrayHelper::map(app\modules\license\models\Status::find()->orderBy('id')->asArray()->all(), 'id', 'status'),
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => '<สถานะ>'],
        'value' => function($model) {
            //$statuses = app\modules\license\models\Status::find()->where(['id' => $model->status])->one();
            if ($model->status == 1) {
                return '<code><i class="glyphicon glyphicon-refresh"></i></code> รอบันทึกผล';
            } elseif ($model->status == 2) {
                return '<li style="color: green" class="glyphicon glyphicon-ok-sign"></li> อนุญาต';
            } elseif ($model->status == 3) {
                return '<li style="color: red" class="glyphicon glyphicon-remove"></li> ไม่อนุญาต';
            } elseif ($model->status == 4) {
                return '<li style="color: green" class="glyphicon glyphicon-ok"></li> บันทึกผลตรวจแล้ว';
            } {
                return '';
            }
        }
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_moo',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_tmb',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_amp',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_chw',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_phone',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'date_request',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'evidence',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'evidence_other',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_cid',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_pname',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_fname',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_lname',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_dob',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_age',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_sex',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'store_own_nation',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'date_key',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'status',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'evidence_confirm',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'evidence_confirm_detail',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_id_confirm',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'date_confirm',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'service_fee',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'bill_book',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'bill_no',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'bill_date',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'date_book_final',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_id_final',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '180px;',
        'template' => '{view} {update} {delete}',
        'buttons' => [
            'view' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-print"></i>', $url
                                , ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'พิมพ์/รายละเอียด']);
            },
            'update' => function($url, $model, $key) {

                return Html::a('<i class="glyphicon glyphicon-edit"></i>', ['/license/receive-final/update', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไข']);
            },
            'delete' => function($url, $model, $key) {
                if (Yii::$app->user->identity->id == \app\models\Users::ROLE_ADMIN) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'ข้อมูลที่เลือกจะถูกลบออกจากโปรแกรม!!'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                                'class' => 'btn btn-default'
                    ]);
                }
            }
        ]
    ],
];
