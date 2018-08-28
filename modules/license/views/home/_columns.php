<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\license\models\Cchangwat;
use app\modules\license\models\Campur;
use app\modules\license\models\Ctambon;
use app\modules\license\models\Village;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'HOSPCODE',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'HID',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'HOUSE_ID',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'ROOMNO',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'HOUSE',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'VILLAGE',
        'value' => 'villageno.NAME'
//         'value'=> function($model){
//            $models= Village::find()->where(['id'=>$model->VILLAGE])->one();            
//            if($model->VILLAGE != ''){
//                return $models->NAME;
//            } else {
//                return '';
//            }
//         },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'HOUSE',
        'value' => function($model) {
            $c = Cchangwat::find()->where(['changwatcode' => $model->CHANGWAT])->one();
            $a = Campur::find()->where(['ampurcodefull' => $model->AMPUR])->one();
            $t = Ctambon::find()->where(['ampurcode' => $a->ampurcodefull])->one();
            if ($model->HOUSE != '') {
                return ' ต. ' . $t->tambonname . ' อ. ' . $a->ampurname . '  จ. ' . $c->changwatname;
            } else {
                return '';
            }
        },
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'SOIMAIN',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ROAD',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'VILLANAME',
    // ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'TAMBON',
//     ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'AMPUR',
//     ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'CHANGWAT',
//     ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'TELEPHONE',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'LATITUDE',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'LONGITUDE',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'OUTDATE',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'D_UPDATE',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'public_home_data_chunk_id_temp',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'TYPEAREA',
        'value' => function($model) {            
            if ($model->typeareaname == '1') {
                return 'ในเขตเทศบาล';
            } elseif ($model->typeareaname == '4') {
                return 'นอกเขตเทศบาล';
            } else {
                return '';
            }
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '120px;',
        'template' => '{view} {update}',
        'buttons' => [
            'view' => function($url, $model, $key) {

                return Html::a('<i class="glyphicon glyphicon-search"></i>', $url
                                , ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
            },
            'update' => function($url, $model, $key) {

                return Html::a('<i class="glyphicon glyphicon-edit"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไข']);
            },
//                    'delete'=>function($url,$model,$key){
//                         return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
//                                'title' => Yii::t('yii', 'Delete'),
//                                'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                                'data-method' => 'post',
//                                'data-pjax' => '0',
//                                'class'=>'btn btn-default'
//                                ]);
//                    }
        ]
    ],
];
