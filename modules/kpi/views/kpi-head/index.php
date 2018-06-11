<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\modules\kpi\models\KpiSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kpi\models\KpiHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TemPlate';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<style>

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
 <?php if(!Yii::$app->user->isGuest){ ?>
        <p class="pull-right">
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> สร้างTemPlate', ['create'], ['class' => 'btn btn-primary','role'=>'modal-remote']) ?>
            <?php // ('<i class="glyphicon glyphicon-plus"></i> สร้าง Kpi', ['/kpi/kpi/create'], ['class' => 'btn btn-info','role'=>'modal-remote']) ?>
        
        </p>
 <?php } ?>
        <br><br>
<div class="kpi-head-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
              //  ['content'=>
//                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
//                    ['role'=>'modal-remote','title'=> 'Create new Kpi Heads','class'=>'btn btn-success'])
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
//                    '{export}',
                    
//                ],
                
            ],          
            'striped' => FALSE,
            'hover'=>true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> TemPlate Kpi',
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
])?>
<?php Modal::end(); ?>
