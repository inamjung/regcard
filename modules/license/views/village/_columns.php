<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
//        'attribute'=>'VID',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'NAME',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'TYPEAREA',
        'value'=> function($model){
            if($model->TYPEAREA != '' and $model->TYPEAREA == '1' or $model->TYPEAREA == '' or $model->TYPEAREA == '3'){
                return 'ในเขตเทศบาล';
            }elseif ($model->TYPEAREA != '' and $model->TYPEAREA == '0' or $model->TYPEAREA == '4' or $model->TYPEAREA == '5') {
                return 'นอกเขตเทศบาล';
            } else {
                return '';
            }
        }
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'D_UPDATE',
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '120px;',
        'template' => '{view} {update}',
        'buttons' => [
            
            'view' => function($url, $model, $key) {
       
                return Html::a('<i class="glyphicon glyphicon-search"></i>',
                                $url                               
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