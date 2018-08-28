
<?php

use yii\helpers\Url;
use app\modules\license\models\Regconfig;
use app\modules\license\models\Thaiaddress;
use yii\helpers\Html;


$regc = Regconfig::find()->one();
$add = Thaiaddress::find()->where(['addressid' => $regc->addressid])->one();

$models = Regconfig::find()->one();
?>


<div class="row" style="text-align: center; margin-top: 80px;"> 
     
      <?= Html::img('pictures/'.$models->logo,['class'=>'img-responsive center-block','width'=>350])?>
    <h1>
        ระบบทะเบียนผู้ประกอบกิจการ
    </h1>
    <h3>
        เทศบาล&nbsp;<?= $add->full_name; ?>
    </h3>
    
    <div>
        <?= Html::a('<code><i class="glyphicon glyphicon-print"></i></code> แบบฟอร์ม คำขอแจ้ง',['/license/receive/requrest01/'],['target'=>'_blank'])?>  <br/>
        <?= Html::a('<code><i class="glyphicon glyphicon-print"></i></code> แบบฟอร์ม คำขอรับใบอนุญาต/ต่ออายุใบอนุญาต',['/license/receive/requrest02/'],['target'=>'_blank'])?>
    </div>

</div>