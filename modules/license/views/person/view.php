<?php

use yii\widgets\DetailView;
use app\modules\license\models\Cprename;
use app\modules\license\models\ProvisNation;

/* @var $this yii\web\View */
/* @var $model app\modules\license\models\Person */
?>
<div class="person-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'HOSPCODE',
            'CID',
            //'PID',
            'HID',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'PRENAME',
                'value' => function($model) {
                    $p = Cprename::find()->where(['id' => $model->PRENAME])->one();
                    if ($model->PRENAME != '') {
                        return $p->title_th;
                    } else {
                        return '';
                    }
                },
            ],
            'NAME',
            'LNAME',
           
            [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=> 'SEX',
         'value'=> function($model){
            if($model->SEX != '' and $model->TYPEAREA == '1'){
                return 'ชาย';
            }elseif ($model->TYPEAREA == '2' ) {
                return 'หญิง';
            } else {
                return '';
            }
        }
     ],            
            'BIRTH',
//            'MSTATUS',
//            'OCCUPATION',
//            'RACE',
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
//            'RELIGION',
//            'EDUCATION',
//            'MOVEIN',
//            'DISCHARGE',
//            'DDISCHARGE',
//            'ABOGROUP',
//            'RHGROUP',
//            'LABOR',
            'PASSPORT',
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
//            'D_UPDATE',
//            'public_person_data_chunk_id_temp',
        ],
    ])
    ?>

</div>
