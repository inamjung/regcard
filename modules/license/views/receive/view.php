<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\license\models\Receive;
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\Evidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
?>
<div class="receive-view">
    <style>
        .modal.in .modal-dialog{
            width: 65%;
        }
    </style>
    <?=
    Html::a('<code><i class="glyphicon glyphicon-print"></i><u> แบบคำขอ</u></code>', [
        'report01', 'id' => $model->id], [
        'target' => '_blank'])
    ?>

    <p>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"> </div>
                <div class="panel-body">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'code_no',
                            [
                                'attribute' => 'date_request',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Yii::$app->thaiFormatter->asDate($model->date_request, 'php:d-m-Y');
                                }
                            ],
                            'place_request',
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'store_type',
                                'value' => function($model) {
                                    if ($model->store_type != '') {
                                        if ($model->store_type == '1') {
                                            return 'ขอรับ/ต่ออายุใบอนุญาต';
                                        } elseif ($model->store_type == '2') {
                                            return 'ขอจัดตั้งสถานที่';
                                        } else {
                                            return '';
                                        }
                                    }
                                }
                            ],
                            'store_name',
                            'store_addr',
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'store_own_cid',
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'store_own_pname',
                                'label' => 'ชื่อเจ้าของกิจการ',
                                'value' => function($model) {
                                    if ($model->store_own_fname != '') {
                                        return $model->store_own_pname. '  ' .$model->store_own_fname . '  ' . $model->store_own_lname;
                                    } else {
                                        return '';
                                    }
                                }
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'label' => 'ที่อยู่ตามบัตรประชาชน',
                                'attribute' => 'store_own_addr',
                            ],
                            'store_phone',
                        ],
                    ])
                    ?>
                    <table>
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เอกสาร/หลักฐานที่นำมา</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach (ReceiveDetailEvidence::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->evidencename->evidence; ?></td>                               

                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table> 
                    <hr/>
                    <table> 
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เอกสาร/หลักฐานที่ไม่ครบ</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->evidencenamenot->evidence; ?></td>                               

                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'date_key',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->thaiFormatter->asDate($model->date_key, 'php:d-m-Y');
                }
            ],
            
             [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model) {
                $models = \app\models\Users::find()->where(['id'=>$model->user_id])->one();
                if($model->user_id !=''){
                    return $models->name;
                    } else {
                        return '';
                    }  
                }
            ],       
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    $statuses = app\modules\license\models\Status::find()->where(['id' => $model->status])->one();
                    if ($model->status == 1) {
                        return '<code><i class="glyphicon glyphicon-refresh"></i></code> รอบันทึกผล';
                    } elseif ($model->status == 2) {
                        return '<li style="color: green" class="glyphicon glyphicon-ok-sign"></li> อนุญาต';
                    } elseif ($model->status == 3) {
                        return '<li style="color: red" class="glyphicon glyphicon-remove"></li> ไม่อนุญาต';
                    } elseif ($model->status == 4) {
                        return '<li style="color: green" class="glyphicon glyphicon-ok"></li> บันทึกผลตรวจแล้ว';
                    } else {
                        return '';
                    }
                }
            ],
        ],
    ])
    ?>

</div>
<p class="pull-right">
    <?php
    if ($model->status == 1) {
        echo Html::a('<code><i class="glyphicon glyphicon-edit"></i> แก้ไข</code>', [
            'update', 'id' => $model->id], ['class' => 'btn btn-default', 'role' => 'modal-remote'
        ]);
    } else {
        echo '';
    }
    ?>
</p>
<p class="pull-left">
    <?php
    echo Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
    ?>
</p>

