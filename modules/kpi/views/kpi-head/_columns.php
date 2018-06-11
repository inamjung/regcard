<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\kpi\models\KpiSearch;
use kartik\grid\ExpandRowColumn;
use kartik\grid\GridView;

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
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'value'=> function($model, $key, $index, $column){
//                    //return GridView::ROW_COLLAPSED;
//                    return GridView::ROW_EXPANDED;
//                },
//                'detail'=> function($model, $key, $index, $column){
//                    $searchModel = new KpiSearch();
//                    $searchModel ->kpi_h_id = $model->id;
//                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                    
//                    return Yii::$app->controller->renderPartial('_kpiexpan',[
//                        'searchModel'=> $searchModel,
//                        'dataProvider'=> $dataProvider,
//                    ]);
//                 }
//    ],
            
    [
        'label'=>'ตัวชี้วัดตามเทมเพลต',
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name_h',
    ],        
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mond_id',
        'value'=> function($model){
            $model = \app\modules\kpi\models\KMond::find()->where(['id'=>$model->mond_id])->one();
            return $model->kpi_mond;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'pan_id',
        'value'=> function($model){
            $model = app\modules\kpi\models\KPan::find()->where(['id'=>$model->pan_id])->one();
            return $model->kpi_pan;
        }
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'kong_id',
//        'value'=> function($model){
//            $model = app\modules\kpi\models\KKong::find()->where(['id'=>$model->kong_id])->one();
//            return $model->kpi_kong;
//        }
//    ],
//    [
//        'label'=>'แสดงผล',
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'level_id',
//        'value'=> function($model){
//            $models = app\modules\kpi\models\KLevel::find()->where(['IN','id',$model->level_id])->one();
//            return $models->kpi_pon_level;
//        },
//        'hAlign' => 'center',
//        'vAlign' => 'middle',          
//    ],
    
                
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kpitype_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kpidesc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'perfomance',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'target',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fomula',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'source',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kpiyear',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kpidepart_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_kpi_h',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'statuskpi',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'docs',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ref',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'create_d',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'upadte_d',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions'=>[
          'noWrap' => true
        ], 
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['data-pjax' =>0,'role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   