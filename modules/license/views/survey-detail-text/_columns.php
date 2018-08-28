<?php
use yii\helpers\Url;
use yii\helpers\Html;
return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
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
//        'attribute'=>'store_at_id',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
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
                        $.ajax('index.php?r=license/survey-detail-text/delete&id=$model->id', {
                          type: 'POST',
                        }).done(function(data) {
                          //$.pjax.reload({container: '#pjax-container'});
                          showtext();
                        });
                      }
                      return false;
                      ",
                        ]);
                    },
                ]
            ],

];   