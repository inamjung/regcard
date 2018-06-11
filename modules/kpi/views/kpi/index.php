<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kpi\models\KpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kpi';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<?php Pjax::begin(); ?>
<div class="kpi-index">    
    <div class="panel panel-warning">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4><i class="glyphicon glyphicon-search"></i> เครื่องมือค้นหา</h4>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="accordion-body collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="panel panel-info">
                    <div class="panel-header">                        
                    </div>
                    <div class="panel-body">
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
            </div>
        </div>   
    </div>    

    <?php if (!Yii::$app->user->isGuest) { ?>
        <p class="pull-right">
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> KPI', ['create'], ['class' => 'btn btn-success', 'role' => 'modal-remote', 'title' => 'เพิ่มรายการKPI']) ?>
        </p>
    <?php } ?>
    <br><br>

    <div id="ajaxCrudDatatable">
        <?=
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
//                ['content'=>
//                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
//                    ['role'=>'modal-remote','title'=> 'Create new Kpis','class'=>'btn btn-default']).
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
//                    '{export}'
//                ],
            ],
            'striped' => false,
            'hover' => true,
            'condensed' => true,
            'responsive' => true,
            'beforeHeader' => [
                [
                    'columns' => [
                        ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => 'รายการตัวชี้วัด', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => 'เทมเพลต', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => 'ผลงานย้อนหลัง', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                        ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => 'ผลงานปี 2561', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                        ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => 'ประเภทตัวชี้วัด', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                        ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                    ],
                    'options' => ['class' => 'skip-export'] // remove this row from export
                ]
            ],
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> รายการตัวชี้วัด [โรงพยาบาลพหลพลพยุหเสนา กาญจนบุรี]',
                'before' => '<code>ประเภทตัวชี้วัด [moph= กระทรวง], [PA= ตรวจราชการ], [HA= HA/โรงพยาบาล]</code>',
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
<?php Pjax::end(); ?>
<?php
Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => ['backdrop' => 'static']
])
?>
<?php Modal::end(); ?>
