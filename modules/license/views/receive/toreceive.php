<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

$this->title = 'บันทึกคำขอ';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="receive-index">
    <?= Html::a('<i class="glyphicon glyphicon-log-out"></i> กลับ', ['receive/index'], ['role' => 'modal-remote_', 'title' => 'กลับ', 'class' => 'btn btn-success']);
    ?>

    <div id="ajaxCrudDatatable">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'striped' => false,
            'hover' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => '<i class="glyphicon glyphicon-home"></i> ที่อยู่ค้นตามเลขบัตรประชาชน',
            ],
            'toolbar' => [],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],


                [
                    'class' => '\kartik\grid\DataColumn',
                    'header' => 'ส่งเข้าระบบ',
                    'attribute' => 'CID',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a('<i class="glyphicon glyphicon-edit"></i>', [
                                    'receive/addreceive/',
                                    'ttname' => $model['ttname'],
                                    'VILLAGE' => $model['VILLAGE'],
                                    'TAMBON' => $model['TAMBON'],
                                    'AMPUR' => $model['AMPUR'],
                                    'CHANGWAT' => $model['CHANGWAT'],
                                    'addrname' => $model['addrname'],
                                    'ampurname' => $model['ampurname'],
                                    'changwatname' => $model['changwatname'],
                                    'CID' => $model['CID'],
                                    'title_th' => $model['title_th'],
                                    'fname' => $model['fname'],
                                    'LNAME' => $model['LNAME'],
                                        ], ['class' => 'btn btn-info', 'title' => 'ส่งเข้าระบบยื่นคำขอ']);
                    },
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'pername',
                    'header' => 'ชื่อ-นามสกุล'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'vilname',
                    'header' => 'ที่อยู่',
                    'value' => function($model) {
                        return $model['HOUSE'] . ' ' .$model['vilname'] . ' ' . $model['full_name'];
                    },
                //'width' => '300px;'
                ],
//                'vilname',
            //'addrname',
//                'full_name',
//                'VILLAGE',
//                'TAMBON',
//                'AMPUR',
//                'CHANGWAT',
//                'changwatname',
//                'ampurname',
//                    [
//                        'class' => '\kartik\grid\DataColumn',
//                        'label' => 'ตรวจ',
//                        'format'=>'raw',
//                        'value'=> function($model){
//                            return Html::a('<i class="glyphicon glyphicon-edit"></i>',[
//                                'doctor-screen-history/cctodoctor/',
//                                'hn'=>$model['hn'],
//                                'vn'=>$model['vn'],
//                                'weight'=>$model['weight'],
//                                'height'=>$model['height'],
//                                'height'=>$model['height'],
//                                'waist'=>$model['waist'],
//                                'temp'=>$model['temp'],
//                                'sbp'=>$model['sbp'],
//                                'dbp'=>$model['dbp'],
//                                'cc_text'=>$model['cc_text'],
//                                'fh_text'=>$model['fh_text'],
//                                
//                                ],
//                                    ['class'=>'btn btn-info','title'=>'ตรวจรายนี้']);
//                        },
//                        //'attribute' => 'hn',
//                        'headerOptions' => ['class' => 'text-center'],
//                        'contentOptions' => ['class' => 'text-center']
//                    ],
            ]
        ]);
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
