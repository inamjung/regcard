<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
?>
<div class="users-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'email:email',
//            'password_hash',
//            'auth_key',
//            'confirmed_at',
//            'unconfirmed_email:email',
//            'blocked_at',
//            'registration_ip',
//            'created_at',
//            'updated_at',
//            'flags',
//            'last_login_at',
//            'status',
//            'password_reset_token',
            
       [
                'attribute' => 'name',
                'value' => function($model) {
                    return $model->pname . '' . $model->name;
                },
            ],
                [
                'attribute' => 'dep_id',
                'value' => function($model) {
                    $model = \app\models\Departments::find()->where(['id' => $model->dep_id])->one();
                    return $model->name;
                },
            ],
                [
                'attribute' => 'occ_id',
                'value' => function($model) {
                    $model = app\models\Occupations::find()->where(['id' => $model->occ_id])->one();
                    return $model->name;
                },
            ],
                [
                'attribute' => 'pos_no',
            ],
                [
                'attribute' => 'pos_id',
                'value' => function($model) {
                    $model = app\models\Positions::find()->where(['id' => $model->pos_id])->one();
                    return $model->name;
                },
            ],
            'pos_no',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    if ($model->role == 1) {
                        return 'Admin';
                    }                   
                    if ($model->role == 10) {
                        return 'User';
                    }
                    if ($model->role == 20) {
                        return 'Leader';
                    }
                }
            ],
        //'pname',
        //'name',
        //'dep_id',
        //'occ_id',
        //'occ_no',
        //'pos_id',
        ],
    ])
    ?>

</div>
