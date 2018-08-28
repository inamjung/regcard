<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

//$this->title = 'xxx';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storeaddr">

    <h3><?= Html::encode($this->title) ?></h3><p>

   <?php Pjax::begin() ;?>
        
   <?php echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],   
    //'filterModel'=>$searchModel,    
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => false,
    'panel' => [
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,        
    ],    

]);
?>  

<?php Pjax::end();?>

</div>

