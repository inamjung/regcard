<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

use yii\widgets\Pjax;

$this->title = 'การตรวจสถานประกอบกิจการ';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="store-at-index">

    <div id="ajaxCrudDatatable">
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
//                    ['role'=>'modal-remote','title'=> 'Create new Store Ats','class'=>'btn btn-default']).
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
            'hover' => TRUE,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-retweet"></i> บันทึกผลการตรวจ',
                'before' => '<code>ทะเบียนรายการตรวจสถานประกอบกิจการ</code>' . '<br/>' .
                '<code>แสดงเฉาพะ คำขอที่ยัง ไม่ได้ ตรวจสภาพสถานประกอบกิจการ</code>',
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