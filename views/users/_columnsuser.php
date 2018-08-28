<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'email',
//    ],
    [
                'attribute' => 'role',
                'value' => function($model) {
                    if ($model->role == 1) {
                        return 'Admin';
                    }                   
                    if ($model->role == 10) {
                        return 'User';
                    }
                    if ($model->role == 20) {
                        return 'Leader';
                    }
                }
            ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'name',
         'value' => function($model) {  
            $uname = app\models\Users::find()->where(['id'=>$model->id])->one();
            if($model->name !=''){
            return $model->pname.''.$model->name;
            } else {
               return ''; 
            }
        },
     ],     
          
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'pos_id',
         'value' => function($model) {
            $upos = app\models\Positions::find()->where(['id' => $model->pos_id])->one();
            if($model->pos_id !=''){
                return $upos->name;
                } else {
                   return ''; 
                }
        },
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'pos_no',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'dep_id',
         'value' => function($model) {
            $udep = app\models\Departments::find()->where(['id' => $model->dep_id])->one();
            if($model->dep_id !=''){
                return $udep->name;
                } else {
                   return ''; 
                }
        },
     ],           
     [
           'label'=>'password',
           'format' => 'raw',
           'value'=>function ($data) {
            return Html::a('เปลี่ยนpassword',['/user/settings/account'],
                ['class' => 'btn btn-xs btn-warning btn-block']
                );
        },
    ],           
    [
                'class' => 'kartik\grid\ActionColumn',
                'contentOptions'=>[
                    'noWrap' => true
                  ], 
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}</div>',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-search"></i>',$url,['class'=>'btn btn-default','role'=>'modal-remote','title'=>'ดู']);
                    }, 
                    'update'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-edit"></i>',$url,[
                            'class'=>'btn btn-default',
                            'role'=>'modal-remote',
                            'title'=>'แก้ไข'
                            ]);
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