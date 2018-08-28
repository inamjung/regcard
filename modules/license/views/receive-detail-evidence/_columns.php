<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\license\models\Evidence;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'evidence_id',
        'value' => function($model) {
            $models = Evidence::find()->where(['id' => $model->evidence_id])->one();
            if ($model->evidence_id != '') {
                return $models->evidence;
            } else {
                return'';
            }
        }
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
                        $.ajax('index.php?r=license/receive-detail-evidence/delete&id=$model->id', {
                          type: 'POST',
                        }).done(function(data) {                         
                          showevidence();
                        });
                      }
                      return false;
                      ",
                ]);
            },
        ]
    ],
];
