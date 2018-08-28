<?php

use yii\widgets\DetailView;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\SurveyType;
use app\modules\license\models\SurveyDetailText;
use yii\helpers\Html;
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\Evidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
use app\models\Users;
?>
<div class="receive-final-view">
    <style>
        .modal.in .modal-dialog{
            width: 65%;
        }
    </style>
    <?php if($model->status == 2){
        echo 
            Html::a('<code><i class="glyphicon glyphicon-print"></i><u> หนังสือรับรองการแจ้ง</u></code>', [
                'reportconfirm', 'id' => $model->id], [
                'target' => '_blank']).


            Html::a('<code><i class="glyphicon glyphicon-print"></i><u> ใบอนุญาตประกอบกิจการ</u></code>', [
                'reportfinal', 'id' => $model->id], [
                'target' => '_blank']);
   
        }else{
            echo '';
        }
    ?>
    
    <p>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"> ข้อมูลคำขอจัดตั้ง/ต่ออายุสถานปรพกอบกิจการ</div>
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
                                        return $model->store_own_pname . $model->store_own_fname . '  ' . $model->store_own_lname;
                                    } else {
                                        return '';
                                    }
                                }
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'label' => 'ที่อยู่',
                                'attribute' => 'store_addr',
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
                            <?php foreach (ReceiveDetailEvidence::find()->where(['receive_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                                <tr>
                                    <td><?= $no++ . ')  '; ?></td>
                                    <td><?= $row->evidencename->evidence; ?></td>
                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table> 
                    <hr>
                    <table>
                        <thead style="background-color: #f7f7f7;">
                            <tr>
                                <td>#</td>
                                <td>เอกสาร/หลักฐานที่ไม่ได้นำมา</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                                <tr>
                                    <td><?= $no++ . ')  '; ?></td>
                                    <td><?= $row->evidencenamenot->evidence; ?></td>
                                </tr>                            
                            <?php endforeach; ?>                            
                        </tbody>                    
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"> ข้อมูลเจ้าหน้าที่ตรวจสถานประกอบการ</div>
                <div class="panel-body">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'date_keysurvey',
                                'label' => 'วันที่ตรวจ',
                                'value' => function($model) {
                                    return Yii::$app->thaiFormatter->asDate($model->date_key, 'php:d-m-Y');
                                }
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'user_id_final',
                                'label' => 'ผู้ตรวจ',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $userat = Users::find()->where(['id' => $model->user_id_final])->one();
                                    if ($model->user_id_final != '') {
                                        return $userat->name;
                                    }  else {
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

                    <div class="panel panel-warning">
                        <div class="panel-heading">ข้อกำหนดตามมาตรฐาน</div>
                        <div class="panel-body">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    [
                                        //'attribute' => 'survey_type',
                                        'format' => 'raw',
                                        'label' => 'ข้อกำหนด',
                                        'value' => function($model) {
                                            $att = app\modules\license\models\StoreAt::find()->where(['receive_id' => $model->receive_id])->one();
                                            if ($att->survey_type == '1') {
                                                return '<li style="color: green" class="glyphicon glyphicon-ok-circle"></li> ครบถ้วนถูกต้องตามข้อกำหนดไว้ในข้อกำหนดของท้องถิ่น';
                                            } elseif ($att->survey_type == '2') {
                                                return '<i class="glyphicon glyphicon-exclamation-sign"></i> ไม่ครบ คือ';
                                            } else {
                                                return '';
                                            }
                                        }
                                    ],
                                ],
                            ])
                            ?>
                            <table>
                                <thead style="background-color: #f7f7f7;">
                                    <tr>
                                        <td>#</td>
                                        <td>ข้อกำหนดที่ไม่ครบ</td>                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach (SurveyDetailType::find()->where(['store_at_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                                        <tr>
                                            <td><?= $no++ . ')  '; ?></td>
                                            <td><?= $row->typename->name; ?></td>
                                        </tr>                            
                                    <?php endforeach; ?>                            
                                </tbody>                    
                            </table> 

                        </div>
                    </div>

                    <div class="panel panel-warning">
                        <div class="panel-heading">เงื่อนไขการอนุญาต</div>
                        <div class="panel-body">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    [
                                        //'attribute' => 'survey_text',
                                        'format' => 'raw',
                                        'label' => 'ความเห็นผู้สำรวจ',
                                        'value' => function($model) {
                                            $attext = app\modules\license\models\StoreAt::find()->where(['receive_id' => $model->receive_id])->one();
                                            if ($attext->survey_text == '1') {
                                                return '<li style="color: red" class="glyphicon glyphicon-remove"></li> ไม่สมควรอนุญาต';
                                            } elseif ($attext->survey_text == '2') {
                                                return '<li style="color: green" class="glyphicon glyphicon-ok-circle"></li> สมควรอนุญาต';
                                            } elseif ($attext->survey_text == '3') {
                                                return '<li style="color: grey" class="glyphicon glyphicon-exclamation-sign"></li> สมควรอนุญาตโดยมีเงื่อนไข ดังนี้';
                                            } else {
                                                return '';
                                            }
                                        }
                                    ],
                                ],
                            ])
                            ?>
                            <hr>
                            <?php
                            $bb = SurveyDetailText::find()->where(['store_at_id' => $model->receive_id])->orderBy('id')->all();
                            ?>
                            <table> 
                                <thead style="background-color: #f7f7f7;">
                                    <tr>
                                        <td>#</td>
                                        <td>เงื่อนไขการอนุญาต</td>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($bb as $datas): ?>
                                        <tr>
                                            <td><?= $i++ . ')'; ?></td>
                                            <td><?= $datas->name; ?></td>                            
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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