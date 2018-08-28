<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;


$this->title = 'ออกใบอนุญาต';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="receive-final-index">
   
  <div class="row">
        <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">                   
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="glyphicon glyphicon-search"></i> ค้นหาข้อมูล
                        </a>                    
                </div>
                <div id="collapseOne" class="accordion-body collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
            </div>
    </div>
    <div id="ajaxCrudDatatable">  
        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
//                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
//                    ['role'=>'modal-remote','title'=> 'Create new Receive Finals','class'=>'btn btn-default']).
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'exportConfig' => [
                GridView::EXCEL => []
            ],
            'striped' => false,
            'hover' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-thumbs-up"></i> ออกใบอนุญาต',
                'before' => '<code>ทะเบียนรอออกใบอนุญาตสถานประกอบกิจการ</code>' . '<br/>' .
                '<code>แสดงเฉาพะ คำขอที่ ผ่าน การตรวจสภาพสถานประกอบกิจการแล้ว</code>',
//                'after'=>BulkButtonWidget::widget([
//                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
//                                ["bulk-delete"] ,
//                                [
//                                    "class"=>"btn btn-danger btn-xs",
//                                    'role'=>'modal-remote-bulk',
//                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                                    'data-request-method'=>'post',
//                                    'data-confirm-title'=>'Are you sure?',
//                                    'data-confirm-message'=>'Are you sure want to delete this item'
//                                ]),
//                        ]).                        
                '<div class="clearfix"></div>',
            ]
        ])
        ?>
        <?php  Pjax::end(); ?>
    </div>
</div>
<?php
Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
])
?>
<?php Modal::end(); ?>
