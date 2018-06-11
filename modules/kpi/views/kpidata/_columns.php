<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
//use yii\helpers\Json;
//use kartik\grid\GridView;

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
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'kpi_id',
//    ],
    [//0
        'header' => 'ครั้งที่',
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'frequency_no',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '40px',
    ],
    [//1
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'d_end_result',
        'format' => 'raw',
        'value' => function($model) {
            return Yii::$app->thaiFormatter->asDate($model->d_end_result, 'php:d-m-Y');
        },
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '100px',
    ],

     [//2
       'class'=>'\kartik\grid\DataColumn',
       'attribute'=>'denom_c',
        'header' => 'ตัวคูณคงที่',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'pageSummary' => true,
        'width' => '200px',
        'class' => 'kartik\grid\EditableColumn',
        'refreshGrid' => true,
        'editableOptions' => [
            'asPopover' => false,
            'formOptions' => [
                'action' => \yii\helpers\Url::to(['/kpi/kpidata/editable']),
                'method' => 'post'
            ],
            'valueIfNull' => '-',
            'submitButton' => ['class' => 'btn btn-primary', 'icon' => '<i class="glyphicon glyphicon-ok"></i>'],
            'resetButton' => ['class' => 'btn btn-warning', 'icon' => '<i class="glyphicon glyphicon-refresh"></i>'],
        ],
    ],           
     [//3
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'devide',
        'header' => '(B) จำนวนเป้าหมาย',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'pageSummary' => true,
        'width' => '200px',
        'class' => 'kartik\grid\EditableColumn',
        'refreshGrid' => true,
        'editableOptions' => [
            'asPopover' => false,
            'formOptions' => [
                'action' => \yii\helpers\Url::to(['/kpi/kpidata/editable']),
                'method' => 'post'
            ],
            'valueIfNull' => '-',
            'submitButton' => ['class' => 'btn btn-primary', 'icon' => '<i class="glyphicon glyphicon-ok"></i>'],
            'resetButton' => ['class' => 'btn btn-warning', 'icon' => '<i class="glyphicon glyphicon-refresh"></i>'],
        ],
    ],              

     [//4
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'denom',
                'header' => '(A) จำนวนผลงาน',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'refreshGrid' => true,
                'editableOptions' => [
                    'asPopover' => false,
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => [
                        'action' => \yii\helpers\Url::to(['/kpi/kpidata/editable']),
                        'method' => 'post'
                    ],
                    'valueIfNull' => '-',
                    'submitButton' => ['class' => 'btn btn-primary', 'icon' => '<i class="glyphicon glyphicon-ok"></i>'],
                    'resetButton' => ['class' => 'btn btn-warning', 'icon' => '<i class="glyphicon glyphicon-refresh"></i>'],

                ],
                'contentOptions' => ['class' => 'pjax-load'],
            ],
    [//5
        'class' => 'kartik\grid\FormulaColumn',
        'header' => '(A/B) *'.$model->denom_c.'  '.' <span style="color: #ff7f50;">ค่าผลลัพธ์(ผลงาน / เป้า)*ตัวคูณคงที่</span>',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'value' => function ($model, $key, $index, $widget) {
            $total = @($model->denom / $model->devide) * $model->denom_c;
            return $total;
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'format' => ['decimal', 2],
        'mergeHeader' => true,
        'pageSummary' => true,
        'footer' => true
    ],
        [
        'class' => 'kartik\grid\FormulaColumn',
        'header' => '<span style="color: #c031d0;">แปรผล</span>',
        'format' => 'raw',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'value' => function ($model, $key, $index, $widget) {
            $models = app\modules\kpi\models\Kpi::find()->where(['id'=>$model->kpi_id])->one();
            $p = compact('model', 'key', 'index');
            $target = $widget->col(5, $p);
            
            //operation '>='
            if ($models->operation == '>=' && $target >= $model->goal) {
                return '<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
            } elseif ($models->operation == '>=' && $target > 0 && $target < $model->goal) {
                return '<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
            } elseif($model->denom == '') {
                return '<span style="color: #141415;">รอผล </span><i style="color: #141415" class="glyphicon glyphicon-repeat"></i>';
            
            //operation '<='    
            } elseif ($models->operation == '<=' && $target > $model->goal) {
                return '<span style="color: red">ไม่ผ่าน </span><i style="color:red" class="glyphicon glyphicon-remove"></i>';
            } elseif ($models->operation == '<=' && $target > 0 && $target <= $model->goal) {
                return '<span style="color: green">ผ่าน </span><i style="color:green" class="glyphicon glyphicon-ok"></i>';
                 
            }
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'devide_c',
    // ],

    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'result',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'result_text',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'calc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_id_result',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'d_add',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'d_edit',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'docs',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'goal',
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
        // 'attribute'=>'qty_kan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kpilist_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ref',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'contentOptions' => [
            'noWrap' => true
        ],
        'vAlign'=>'middle',
         'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update_}</div>',
        'urlCreator' => function($action, $model, $key, $index, $url) {
            return Url::to(['/kpi/kpidata/' . $action, 'id' => $key]);
        },
        'buttons' => [
            'view' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
//                        if($model->kan == 1){
//                            return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default','role'=>'modal-remote','title'=>'บันทึกข้อมูลเกณฑ์ย่อย']);
//                        }
                //return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default','role'=>'modal-remote_','title'=>'บันทึกเกณฑ์ย่อย']);
            },
//        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
//        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
//                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                          'data-request-method'=>'post',
//                          'data-toggle'=>'tooltip',
//                          'data-confirm-title'=>'Are you sure?',
//                          'data-confirm-message'=>'Are you sure want to delete this item'], 
        ],
    ]
];   