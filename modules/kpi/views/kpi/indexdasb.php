<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;


$this->title = 'Kpi';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<?php Pjax::begin(); ?>
<div class="kpi-indexdasb">
    <div class="row">
        <div class="col-sm-4">
            <div id="ajaxCrudDatatable">
        <?=
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columnsdasb.php'),
            'toolbar' => [
            ],
            'striped' => false,
            'hover' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> รายการตัวชี้วัด แยกตามหน่วยงานรับผิดชอบ [รพ.อุดรธานี]',
                'before' => '<code>ประเภทตัวชี้วัด [moph= กระทรวง], [PA= ตรวจราชการ], [HA= HA/โรงพยาบาล]</code>',                        
                '<div class="clearfix"></div>',
            ]
        ])
        ?>
    </div>
        </div>
         <div class="col-sm-7">
            
        </div>
    </div>
    
</div>
<?php Pjax::end(); ?>
<?php
Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => ['backdrop' => 'static']
])
?>
<?php Modal::end(); ?>
