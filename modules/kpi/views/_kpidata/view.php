<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kpi\models\Kpidata */
?>
<div class="kpidata-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'kpi_id',
            'frequency_no',
           
            [            
            'attribute'=>'d_end_result',
            'format'=>'raw',    
            'value'=> function($model){
                return Yii::$app->thaiFormatter->asDate($model->d_end_result, 'php:d-m-Y');
                }    
            ],
            'goal',
            'target',        
            'denom',
            'devide',
            'result',
            'result_text',        
            'devide_c',
            'denom_c',
            ['attribute'=>'docs','value'=>$model->listDownloadFiles('docs'),'format'=>'html'],
           /* 
            'calc',
            'user_id_result',
            'd_add',
            'd_edit',            
            'ref',            
            'qty_kan',
            'kan',
            'kpilist_id',
           
            */
        ],
    ]) ?>

</div>
