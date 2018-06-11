<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;




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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kpiname',
        'format' => 'raw',
        'value'=> function($model){
            return $model->kpiname.' '. $model->showtype($model->id);
        },
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
    [
        // 'class'=>'\kartik\grid\DataColumn',
        'label' => '',
        // 'attribute'=>'kpi_h_id',
        'value' => function($model) {
            if ($model->docs != '' && $model->docs != 'null') {
                return
                        Html::a('<i style="color: #2ddffd" class="glyphicon glyphicon-file"></i>', ['/kpi/kpi/viewdocs', 'id' => $model->id], ['role' => 'modal-remote', 'title' => 'ดูไฟล์']);
            }
        },
        'format' => 'raw',
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => '2558',
        //'attribute'=>'kpiname',
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => '2559',
        //'attribute'=>'kpiname',
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => '2560',
        //'attribute'=>'kpiname',
        'hAlign' => 'left',
        'vAlign' => 'middle',
    ],
    [
        'label' => 'เกณฑ์',
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'operation',
        'value' => function($model) {
            return $model->operation . ' ' . $model->goal;
        },
        'width' => '80px',
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => '<span style="color: #ff7f50;">Q1</span>',
        //'attribute'=>'kpiyear',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'format' => 'html',
        'value' => function ($model, $key, $index, $widget) {
            $counta = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])->count();

            if ($counta == 4) {
                $c = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 1])
                        ->one();
                $cc = @round(($c->denom / $c->devide) * $c->denom_c, 2);

                if ($model->operation == '>=') {
                    if ($cc >= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc < $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($cc <= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc > $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
            }
        },
    ],
    [
        //'class'=>'\kartik\grid\DataColumn',
        'header' => '<span style="color: #ff7f50;">Q2</span>',
        //'attribute'=>'kpiyear',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'format' => 'html',
        'value' => function ($model, $key, $index, $widget) {
            $counta = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])->count();

            if ($counta == 2) {
                $b = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 1])
                        ->one();
                $bb = @round(($b->denom / $b->devide) * $b->denom_c, 2);

                if ($model->operation == '>=') {
                    if ($bb >= $b->goal) {
                        return "<span class='badge' style='background-color: green'>$bb</span>";
                    } elseif ($bb < $b->goal) {
                        return "<span class='badge' style='background-color: red'>$bb</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($bb <= $b->goal) {
                        return "<span class='badge' style='background-color: green'>$bb</span>";
                    } elseif ($bb > $b->goal) {
                        return "<span class='badge' style='background-color: red'>$bb</span>";
                    }
                }
            }

            if ($counta == 4) {
                $c = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 2])
                        ->one();
                $cc = @round(($c->denom / $c->devide) * $c->denom_c, 2);
                if ($model->operation == '>=') {
                    if ($cc >= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc < $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($cc <= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc > $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
            }
        },
    ],
    [
        //'class'=>'\kartik\grid\DataColumn',
        'header' => '<span style="color: #ff7f50;">Q3</span>',
        //'attribute'=>'kpiyear',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'format' => 'html',
        'value' => function ($model, $key, $index, $widget) {
            $counta = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])->count();

            if ($counta == 4) {
                $c = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 3])
                        ->one();
                $cc = @round(($c->denom / $c->devide) * $c->denom_c, 2);

                if ($model->operation == '>=') {
                    if ($cc >= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc < $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($cc <= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc > $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
            }
        },
    ],
    [
        //'class'=>'\kartik\grid\DataColumn',
        'header' => '<span style="color: #ff7f50;">Q4</span>',
        //'attribute'=>'kpiyear',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'format' => 'html',
        'value' => function ($model, $key, $index, $widget) {
            $counta = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])->count();

            if ($counta == 1) {
                $a = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 1])
                        ->one();
                $aa = @round(($a->denom / $a->devide) * $a->denom_c, 2);
                if ($model->operation == '>=') {
                    if ($aa >= $a->goal) {
                        return "<span class='badge' style='background-color: green'>$aa</span>";
                    } elseif ($aa < $a->goal) {
                        return "<span class='badge' style='background-color: red'>$aa</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($aa <= $a->goal) {
                        return "<span class='badge' style='background-color: green'>$aa</span>";
                    } elseif ($aa > $a->goal) {
                        return "<span class='badge' style='background-color: red'>$aa</span>";
                    }
                }
            }

            if ($counta == 2) {
                $b = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 2])
                        ->one();
                $bb = @round(($b->denom / $b->devide) * $b->denom_c, 2);
                if ($model->operation == '>=') {
                    if ($bb >= $b->goal) {
                        return "<span class='badge' style='background-color: green'>$bb</span>";
                    } elseif ($bb < $b->goal) {
                        return "<span class='badge' style='background-color: red'>$bb</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($bb <= $b->goal) {
                        return "<span class='badge' style='background-color: green'>$bb</span>";
                    } elseif ($bb > $b->goal) {
                        return "<span class='badge' style='background-color: red'>$bb</span>";
                    }
                }
            }

            if ($counta == 4) {
                $c = \app\modules\kpi\models\Kpidata::find()->where(['kpi_id' => $model->id])
                        ->andWhere(['frequency_no' => 4])
                        ->one();
                $cc = @round(($c->denom / $c->devide) * $c->denom_c, 2);
                if ($model->operation == '>=') {
                    if ($cc >= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc < $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
                if ($model->operation == '<=') {
                    if ($cc <= $c->goal) {
                        return "<span class='badge' style='background-color: green'>$cc</span>";
                    } elseif ($cc > $c->goal) {
                        return "<span class='badge' style='background-color: red'>$cc</span>";
                    }
                }
            }
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'ผู้รับผิดชอบ',
        'attribute' => 'kpidepart_id',
        'value' => function($model) {
            $model = app\modules\kpi\models\Kpidepart::find()->where(['id' => $model->kpidepart_id])->one();
            return $model->kpi_dep;
        },
        'hAlign' => 'center',
        'vAlign' => 'middle'
    ],
    
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
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        //'width' => '100px',
        'dropdown' => true,
        'template' => '{view}{view_}{update}{delete}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
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
                if (!Yii::$app->user->isGuest) {
                    if ($model->user_result_id == Yii::$app->user->identity->id or $model->kpidepart_id == Yii::$app->user->identity->dep_id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
                        return Html::a('คีย์', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'บันทึกข้อมูล']);
                    }
                }
            },
            'view_' => function($url, $model, $key) {
                return Html::a('ดู', ['/kpi/kpi/view_', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'รายละเอียด']);
            },
            'update' => function($url, $model, $key) {
                if (!Yii::$app->user->isGuest) {
                    if ($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
                        return Html::a('แก้ไข', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'แก้ไขตัวชี้วัด']);
                    }
                }
            },
            'delete' => function($url, $model, $key) {
                if (!Yii::$app->user->isGuest) {
                    if ($model->user_result_id == Yii::$app->user->identity->id or Yii::$app->user->identity->role == app\models\Users::ROLE_ADMIN) {
                        return Html::a('ลบ', $url, [
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
