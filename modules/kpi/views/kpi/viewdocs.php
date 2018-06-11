<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidata */
?>
<style>
.modal.in .modal-dialog {
            width: 50%;
        }
.panel {
    background-color: #eee;
}
.panel-primary {
    border-color: rgba(238, 238, 238, 0);
}
.panel-info {
    border-color: rgba(238, 238, 238, 0);
}

</style>
<div class="kpi-view_">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
    /*        
            [               
                'attribute'=>'statuskpi',
                'format' => 'raw',
                'value'=> function($model){
                       return $model->statuskpi == 0 ? "<i style='color:red' class='glyphicon glyphicon-remove'>" :"<i style='color:green' class='glyphicon glyphicon-ok'></i>";
                 }
            ],
            'kpiname',
            'kpidesc',            
           
            'kpiyear',
            [                
                'header'=>'เกณฑ์เป้าหมาย',    
                'attribute' => 'goal',
                'value' => $model->operation . ' ' . $model->goal
             ], 
             'formula',               
            [                
                'header' => 'รายงานครั้ง/ปี',
                'attribute' => 'period_id',
                'value' => function($model) {
                    $model = \app\modules\kpi\models\Kpiperiod::find()->where(['id' => $model->period_id])->one();
                    return $model->description;
                },                
            ],             
            [            
            'attribute'=> 'd_begin_year', 
            'format'=>'raw',    
            'value'=> function($model){
                return Yii::$app->thaiFormatter->asDate($model->d_begin_year, 'php:d-m-Y');
                }    
            ],                
            'target_des',
            'critiria_value',
            'sourcekpi',
             [                
                'attribute' => 'kpidepart_id',
                'value' => function($model) {
                    $model = \app\modules\kpi\models\Kpidepart::find()->where(['id' => $model->kpidepart_id])->one();
                    return $model->kpi_dep;
                },               
            ],
            'user_kpi', 
            'useradd_id',                        
            [            
            'attribute'=> 'd_add',
            'label'=>'วันที่สร้าง',   
            'format'=>'raw',    
            'value'=> function($model){
                return Yii::$app->thaiFormatter->asDate($model->d_add, 'php:d-m-Y');
                }    
            ], 
          */          
            ['attribute'=>'docs','value'=>$model->listDownloadFiles('docs'),'format'=>'html'],            
//            'denom',
//            'devide',
//            'goal_des',
//            'target',            
//            'denom_c',
//            'denom_c_unit',
//            'devide_c',
//            'devide_c_unit',            
//            'useredit_id',
//            'd_edit',
            
            //'docs',
            //'ref'

        ],
    ]) ?>

</div>
