<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\modules\kpi\models\Kpidata;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kpi\models\KpidataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->kpiname;
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="kpidata-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-home"></i>', ['/kpi/kpi/index'],
                    ['role'=>'modal-remote_','title'=> 'กลับหน้าหลัก','class'=>'btn btn-default']).
//                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
//                    ['role'=>'modal-remote','title'=> 'Create new Kpidatas','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/kpi/kpi/view','id'=> $model->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'รีเฟรซ'])
                    //'{toggleData}'.
                    //'{export}'
                ],
            ],          
            'striped' => false,
            'hover'=>true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'info', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> kpidata: แสดงรอบการรายงานผลตัวชี้วัด',
                'before'=> $this->render('kpidetail',['model' => $model]),
//                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
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
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
     //"clientOptions"=>['backdrop'=>'static']
])?>
<?php Modal::end(); ?>
