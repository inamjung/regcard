<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
[
        'class' => '\kartik\grid\DataColumn',
        'label' => 'ผู้รับผิดชอบ',
        'attribute' => 'kpidepart_id',
        'value' => function($model) {
            //$cdeps = \app\modules\kpi\models\Kpidepart::find()->where(['id'=>$model->kpidepart_id])->one();            
           $models = app\modules\kpi\models\Kpidepart::find()->where(['id' => $model->kpidepart_id])->one();
           $ckpi = app\modules\kpi\models\Kpi::find()->where(['kpidepart_id' => $models->id])->all();
           $cc = count($ckpi);
            return $models->kpi_dep;
        },
        'hAlign' => 'left',
        'vAlign' => 'middle'
    ],
[
        'class' => '\kartik\grid\DataColumn',
        'label' => 'KPIที่รับผิดชอบ',
        //'attribute' => 'kpidepart_id',
        'value' => function($model) {
            //$cdeps = \app\modules\kpi\models\Kpidepart::find()->where(['id'=>$model->kpidepart_id])->one();            
           $models = app\modules\kpi\models\Kpidepart::find()->where(['id' => $model->kpidepart_id])->one();
           $ckpi = app\modules\kpi\models\Kpi::find()->where(['kpidepart_id' => $models->id])->all();
           $cc = count($ckpi);
            return $cc;
        },
        'hAlign' => 'left',
        'vAlign' => 'middle'
    ],
//    [
//        // 'class'=>'\kartik\grid\DataColumn',
//        'label' => '',
//        // 'attribute'=>'kpi_h_id',
//        'value' => function($model) {
//            if ($model->docs != '' && $model->docs != 'null') {
//                return
//                        Html::a('<i style="color: #2ddffd" class="glyphicon glyphicon-file"></i>', ['/kpi/kpi/viewdocs', 'id' => $model->id], ['role' => 'modal-remote', 'title' => 'ดูไฟล์']);
//            }
//        },
//        'format' => 'raw',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'header' => '2558',
//        //'attribute'=>'kpiname',
//        'hAlign' => 'left',
//        'vAlign' => 'middle',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'header' => '2559',
//        //'attribute'=>'kpiname',
//        'hAlign' => 'left',
//        'vAlign' => 'middle',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'header' => '2560',
//        //'attribute'=>'kpiname',
//        'hAlign' => 'left',
//        'vAlign' => 'middle',
//    ],
//    [
//        'label' => 'เกณฑ์',
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'operation',
//        'value' => function($model) {
//            return $model->operation . ' ' . $model->goal;
//        },
//        'width' => '80px',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],
    
    
    
//    [
//        'label' => '%',
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'kpiyear',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],
//    [
//        'label' => 'ปี',
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'kpiyear',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],
//    [
//        'label'=>'ประมวลผล(ครั้ง/ปี)',
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'period_id',
//        'hAlign' => 'center',
//        'vAlign' => 'middle', 
//        'value'=> function($model){
//            return $model->dperiods;
//        }
//    ],
//     [
//         
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'goal',
//        'hAlign' => 'center',
//        'vAlign' => 'middle', 
//     ],      
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'d_begin_year',
//    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'goal_des',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'denom',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'denom_c',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'denom_c_unit',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'devide',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'devide_c',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'devide_c_unit',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'target',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'target_des',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'critiria_value',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_kpi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'statuskpi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_result_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'d_add',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_edit_result_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'update_d',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'formula',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'docs',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ref',
    // ],
//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'contentOptions' => [
//            'noWrap' => true
//        ],
//        //'width' => '100px',
//        'dropdown' => true,
//        'template' => '{view}{view_}{update}{delete}',
//        'vAlign' => 'middle',
//        'urlCreator' => function($action, $model, $key, $index) {
//            return Url::to([$action, 'id' => $key]);
//        },
////        'viewOptions'=>['role'=>'modal-remote_','title'=>'View','data-toggle'=>'tooltip'],
////        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
////        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
////                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
////                          'data-request-method'=>'post',
////                          'data-toggle'=>'tooltip',
////                          'data-confirm-title'=>'Are you sure?',
////                          'data-confirm-message'=>'Are you sure want to delete this item'], 
//        'buttons' => [
//            'view' => function($url, $model, $key) {
//                if (!Yii::$app->user->isGuest) {
//                    if ($model->user_result_id == Yii::$app->user->identity->id or $model->kpidepart_id == Yii::$app->user->identity->dep_id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
//                        return Html::a('คีย์', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'บันทึกข้อมูล']);
//                    }
//                }
//            },
//            'view_' => function($url, $model, $key) {
//                return Html::a('ดู', ['/kpi/kpi/view_', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
//            },
//            'update' => function($url, $model, $key) {
//                if (!Yii::$app->user->isGuest) {
//                    if ($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
//                        return Html::a('แก้ไข', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไขตัวชี้วัด']);
//                    }
//                }
//            },
//            'delete' => function($url, $model, $key) {
//                if (!Yii::$app->user->isGuest) {
//                    if ($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
//                        return Html::a('ลบ', $url, [
//                                    'title' => Yii::t('yii', 'Delete'),
//                                    'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                                    'data-method' => 'post',
//                                    'data-pjax' => '0',
//                                    'class' => 'btn btn-default',
//                        ]);
//                    }
//                }
//            }
//        ]
//    ],
];
