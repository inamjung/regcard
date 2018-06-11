<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\kpi\models\KpiSearch;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'kpi_h_id',
//        'value'=> function($model){
//            $model = \app\modules\kpi\models\KpiHead::find()->where(['id'=>$model->kpi_h_id])->one();
//            return $model->name_h;
//        },
//        'hAlign' => 'left',
//        'vAlign' => 'middle',         
//    ],
    [
        'label'=>'ตัวชี้วัดย่อย หรือตัวชี้วัดหลัก(ในกรณีไม่มีตัวชี้วัดย่อย)',
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kpiname',
        'hAlign' => 'left',
        'vAlign' => 'middle', 
    ],
//    [
//        'label'=>'ปี',
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'kpiyear',
//        'hAlign' => 'center',
//        'vAlign' => 'middle', 
//    ],
    [
        //'class'=>'\kartik\grid\DataColumn',
        'header' => '<span style="color: #ff7f50;">ผลงาน**</span>',
        'attribute'=>'kpiyear',
        'hAlign' => 'center',
        'vAlign' => 'middle', 
        'format' => 'raw',        
        'value'=> function($model){
            return $model->checkval($model->id) .$model->checkvals($model->id). '|';
        }
    ],
    [
        'label'=>'ประมวลผล(ครั้ง/ปี)',
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'period_id',
        'hAlign' => 'center',
        'vAlign' => 'middle', 
        'format'=>'raw',
        'value'=> function($model){
            return $model->dperiods.' '.
                    Html::a("<l style='color:blue' class='glyphicon glyphicon-search'></i>" , ['/kpi/kpi/viewuser','id'=>$model->id], ['data-pjax'=>0,'role'=>'modal-remote_']);
        }
    ],
     [
        'label'=>'Goal', 
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'operation',
        'value'=> function($model){           
            return $model->operation.' '.$model->goal ;
        },
        'width'=>'80px',        
        'hAlign' => 'center',
        'vAlign' => 'middle',
     ], 
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
        // 'attribute'=>'kpidepart_id',
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
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
         'noWrap' => true
        ],
        'width'=>'200px',
        'dropdown' => false,
        'template' => '{view} {view_} {update} {delete}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
//        'viewOptions'=>['role'=>'modal-remote_','title'=>'View','data-toggle'=>'tooltip'],
//        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
//                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                          'data-request-method'=>'post',
//                          'data-toggle'=>'tooltip',
//                          'data-confirm-title'=>'Are you sure?',
//                          'data-confirm-message'=>'Are you sure want to delete this item'], 
               
        'buttons' => [             
            'view' => function($url, $model, $key) {
            if(!Yii::$app->user->isGuest){
                if($model->user_result_id == Yii::$app->user->identity->id or $model->kpidepart_id == Yii::$app->user->identity->dep_id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/kpi/kpi/view', 'id' => $model->id], ['data-pjax'=>0,'class' => 'btn btn-default','role' => 'modal-remote_', 'title' => 'บันทึกผลตามรอบ']);
                    }
                }  
            },
             'view_' => function($url, $model, $key) {                 
                     return Html::a('<i class="glyphicon glyphicon-search"></i>', ['/kpi/kpi/view_', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
                },        
            'update' => function($url, $model, $key) {
                if(!Yii::$app->user->isGuest){
                    if($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
                    return Html::a('<i class="glyphicon glyphicon-edit"></i>',['/kpi/kpi/update', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไขตัวชี้วัด']);
                    }
                }              
            },
            'delete' => function($url, $model, $key) {
                if(!Yii::$app->user->isGuest){
                   if($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
                     return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => 'btn btn-default',
                         
                        ]);
                    } 
                }               
            }
        ] 
                
    ],

];   