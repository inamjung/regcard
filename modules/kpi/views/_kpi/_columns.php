<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

//$a = app\modules\kpi\models\Kpidata::find()->where(['kpi_id'=> $model->id])->sum('denom');    
    
   
    
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
        'class' => 'kartik\grid\DataColumn',
        'header'=>'แปรผล',
        'width' => '120px',
        'value'=> function($model){
            $a = app\modules\kpi\models\Kpidata::find()
                    ->where(['kpi_id'=> $model->id])->sum('denom');
            $a1 = app\modules\kpi\models\Kpidata::find()
                    ->where(['kpi_id'=> $model->id])->sum('devide');
            $b = @($a/$a1) * 100;
            
            $denomnull = app\modules\kpi\models\Kpidata::find()->where(['kpi_id'=>$model->id,'denom'=> null])->count();
            $deall = app\modules\kpi\models\Kpidata::find()->where(['kpi_id'=>$model->id])->count();
            $def = @($deall - $denomnull);
       
            //operation '>='
            if($model->operation == '>=' && $b >= $model->goal){
                return round($b,2).' '.'<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
            }elseif ($model->operation == '>=' && $b > 0 && $b < $model->goal) {
                return round($b,2).' '.'<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
            } elseif($def == 0) {
               return round($b,2).' '.'<span style="color: #231e1e;">รอผล </span><i style="color: #231e1e" class="glyphicon glyphicon-repeat"></i>';
            
            //operation '<='     
            }elseif ($model->operation == '<=' && $b > 0 && $b <= $model->goal) {
                return round($b,2).' '.'<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
            } elseif($model->operation == '<=' && $b > $model->goal) {
                return round($b,2).' '.'<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
            }
            
         },
        //'pageSummary' => true,         
        'format' => 'raw',         
        'hAlign' => 'center',
        'vAlign' => 'middle',         
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'kpiyear',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kpiname',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'width' => '400px',
    ],
        [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'รายงานครั้ง/ปี',
        'attribute' => 'period_id',
        'value' => function($model) {
            $model = \app\modules\kpi\models\Kpiperiod::find()->where(['id' => $model->period_id])->one();
            return $model->description;
        },
        //'width' => '80px',        
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
//        [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'kpitype_id',
//        'value' => function($model) {
//            $model = app\modules\kpi\models\Kpitype::find()->where(['id' => $model->kpitype_id])->one();
//            return $model->kpitype;
//        },
//        //'width' => '80px',        
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'เกณฑ์เป้าหมาย',
        'attribute' => 'goal',
        'value' => function($model) {
            return $model->operation . ' ' . $model->goal;
        },
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'ที่มาของเป้าหมาย',
        'attribute' => 'target_des', //ที่มาของ ตัวหาร(เป้าหมาย)
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kpidepart_id',
        'value' => function($model) {
            $model = \app\modules\kpi\models\Kpidepart::find()->where(['id' => $model->kpidepart_id])->one();
            return $model->kpi_dep;
        },
        'filter'=>ArrayHelper::map(app\modules\kpi\models\Kpidepart::find()->orderBy('kpi_dep')->asArray()->all(), 'id', 'kpi_dep'),          
        'filterType'=>GridView::FILTER_SELECT2,           
                    'filterWidgetOptions'=>[
                    'options'=>[
                        'placeholder'=>''
                    ],   
                    'pluginOptions'=>['allowClear'=>true],
                    //'format'=>'raw'    
                ], 
        'width'=>'150px;',       
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_kpi',
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'header'=>'หมายเหตุ',        
        'value'=> function($model){
             if($model->docs != ''&& $model->docs !='null'){
                return 
                Html::a('<i style="color:blue" class="glyphicon glyphicon-file"></i>',['/kpi/kpi/viewdocs','id'=> $model->id],['role' => 'modal-remote','title'=>'ดูไฟล์']);
         }
        },                 
        'format' => 'raw',         
        'hAlign' => 'center',
        'vAlign' => 'middle',         
    ],            
                
    //    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'kpidesc',
//    ],

    /*
      [
      'class' => '\kartik\grid\DataColumn',
      'attribute' => 'denom',//ตัวตั้ง(ผลงาน)
      'hAlign' => 'center',
      'vAlign' => 'middle',
      ],
      [
      'class' => '\kartik\grid\DataColumn',
      'attribute' => 'devide', //ตัวหาร(เป้า)
      'hAlign' => 'center',
      'vAlign' => 'middle',
      ],
      [
      'class' => '\kartik\grid\DataColumn',
      'attribute' => 'target',
      'hAlign' => 'center',
      'vAlign' => 'middle',
      ],
     * 
     */

    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'goal_des',
    // ],            
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'d_begin_year',
    // ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'operation',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//    ],         
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
    // 'attribute'=>'devide_c',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'devide_c_unit',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'critiria_value',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'sourcekpi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'statuskpi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'useradd_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'d_add',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'useredit_id',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'d_edit',
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
//        'dropdown' => false,
//        'vAlign'=>'middle',
//        'urlCreator' => function($action, $model, $key, $index) { 
//                return Url::to([$action,'id'=>$key]);
//        },
//        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
//        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
//                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                          'data-request-method'=>'post',
//                          'data-toggle'=>'tooltip',
//                          'data-confirm-title'=>'Are you sure?',
//                          'data-confirm-message'=>'Are you sure want to delete this item'], 
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '150px',
        'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{view_}{update}{delete}</div>',
        'urlCreator' => function($action, $model, $key, $index, $url) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [             
            'view' => function($url, $model, $key) {
            if(!Yii::$app->user->isGuest){
                if($model->kpidepart_id == Yii::$app->user->identity->dep_id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'บันทึกผลตามรอบ']);
                    }
                }  
            },
             'view_' => function($url, $model, $key) {                 
                     return Html::a('<i class="glyphicon glyphicon-search"></i>', ['/kpi/kpi/view_', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
                },        
            'update' => function($url, $model, $key) {
                if(!Yii::$app->user->isGuest){
                    if($model->useradd_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
                    return Html::a('<i class="glyphicon glyphicon-edit"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไขตัวชี้วัด']);
                    }
                }              
            },
            'delete' => function($url, $model, $key) {
                if(!Yii::$app->user->isGuest){
                   if($model->useradd_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN){
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
