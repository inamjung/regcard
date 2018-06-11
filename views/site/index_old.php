
<?php 
use yii\helpers\Url;

    //$ckpiindex = \app\modules\kpi\models\Kpi::find()->count();
   
?>
<div class="row">
    <div class="col-xs-12 col-md-3" style="color: blue;" >
        
        <?=
        
        \yiister\gentelella\widgets\StatsTile::widget(
            [
                'icon' => 'list-alt',
                'header' => 'จำนวน kpi',                
                'text'=> 'จำนวน คือรายการตัวชี้วัด',
                'number'=>'100 ตัว'
                //'number' => $ckpiindex. ' ตัว ',
                
            ]
        )
        ?>
                
        
    </div>
    <div class="col-xs-12 col-md-3">
        <?=
        \yiister\gentelella\widgets\StatsTile::widget(
            [
                'icon' => 'pie-chart',
                'header' => 'Conversion',
                'text' => 'Users to orders',
                'number' => '1.5%',
            ]
        )
        ?>
    </div>
    <div class="col-xs-12 col-md-3">
        <?=
        \yiister\gentelella\widgets\StatsTile::widget(
            [
                'icon' => 'users',
                'header' => 'Users',
                'text' => 'Count of registered users',
                'number' => '1807',
            ]
        )
        ?>
    </div>
    <div class="col-xs-12 col-md-3">
        <?=
        \yiister\gentelella\widgets\StatsTile::widget(
            [
                'icon' => 'comments-o',
                'header' => 'Reviews',
                'text' => 'The next reviews are not approved',
                'number' => '31',
            ]
        )
        ?>
    </div>
</div>