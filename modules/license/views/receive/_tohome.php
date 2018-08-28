<?php
$this->title = 'ประวัติตรวจ';

use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = $this->title;
$datas = $dataProvider->getModels();
?>

<?php
$form = ActiveForm::begin(['method' => 'get',
            'action' => Url::to(['receive/tohome'])]);
?>

<?php ActiveForm::end(); ?>
<?php
if (count($datas) == 0) {
    echo "<div class='alert alert-info'>ยังไม่มีผลลัพธ์จากการค้นหาข้อมูล</div>";
    return;
}
?>
<?php Pjax::begin(['id' => 'tohome']); ?>
<?php
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => true,
    'hover' => true,
    'striped' => false,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'toolbar' => [
    //'{export}',
    //'{toggleData}'       
    ],
    'exportConfig' => [
        GridView::EXCEL => [],
    //GridView::PDF => []
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        //'vstdate',
        //'pt',
        [
            'label' => 'TAMBON',
            'attribute' => 'TAMBON',
            'format' => 'raw',            
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'label' => 'AMPUR',
            'attribute' => 'AMPUR',
            'format' => 'raw',
            'value' => function($model, $key, $widget) {
                return Html::a($model['AMPUR'], [
                            'receive/tohome1/',
                    //'CID'=>$cid,
                            'AMPUR' => $model['AMPUR'],
                            'TAMBON' => $model['TAMBON']], [
                                //'data-toggle' => "modal",
                                //'data-target' => "#hosvisit",
                                ]
                );
            },
            'contentOptions' => ['class' => 'text-center'],
        ],
    ]
])
?>
<?php Pjax::end() ?>

