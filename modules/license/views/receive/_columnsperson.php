<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\license\models\StoreType;
use kartik\grid\GridView;

return [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fullName',
        'value' => function($model) {
            return $model->NAME . ' ' . $model->LNAME;
        },
        'width' => '300px;'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'NAME',
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'LNAME',
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'CID',
        'header'=>'**คลิกที่หมายเลขบัตรที่ต้องการ',
        'filter' => false,
        'format'=>'raw',
         'value'=> function($model)use($CID) {
                return Html::a(Html::encode($model['CID']), [
                'receive/toreceive', 
                    'CID'=>$model['CID']
                
                    ]
    );
            },
    ],
];
