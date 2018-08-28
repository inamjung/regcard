<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\license\models\Cprename;
use app\modules\license\models\ProvisNation;
use app\modules\license\models\Home;

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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'CID',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'PID',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HID',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'PRENAME',
        'value'=> function($model){
            $p = Cprename::find()->where(['id'=>$model->PRENAME])->one();            
            if($model->PRENAME != ''){
                return $p->title_th;
            } else {
                return '';
            }
         },
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'NAME',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'LNAME',
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'SEX',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'BIRTH',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'MSTATUS',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'OCCUPATION',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'RACE',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'NATION',
         'value'=> function($model){
            $n = ProvisNation::find()->where(['code'=>$model->NATION])->one();            
            if($model->NATION != ''){
                return $n->name;
            } else {
                return '';
            }
         },
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'RELIGION',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'EDUCATION',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'MOVEIN',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'DISCHARGE',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'DDISCHARGE',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ABOGROUP',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'RHGROUP',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'LABOR',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'PASSPORT',
    // ],
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
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'D_UPDATE',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'public_person_data_chunk_id_temp',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{delete} ',
        'options' => ['style' => 'width:15%;'],
        'buttons' => [
            'delete' => function($url, $model, $key) {
                return Html::a(Yii::t('yii', ''), '#', [
                            'class' => ' glyphicon glyphicon-trash',
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'onclick' => "
                      if (confirm('ลบข้อมูล?')) {
                        $.ajax('index.php?r=license/person/delete&id=$model->id', {
                          type: 'POST',
                        }).done(function(data) {                         
                          showperson();
                        });
                      }
                      return false;
                      ",
                ]);
            },
        ]
    ],

];   