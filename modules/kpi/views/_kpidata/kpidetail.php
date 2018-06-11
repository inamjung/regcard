<?php
use app\modules\kpi\models\Kpi;
use app\modules\kpi\models\Kpiitem;
use app\modules\kpi\models\Kpitype;

?>


<div style="font-size: initial;">
ตัวชี้วัด : <code><?=$model->kpiname ;?></code> <br> 
เกณฑ์เป้าหมาย : <code><?=$model->operation .' '.$model->goal?></code>
ความถี่ในการรายงานผล : <code><?=$model->dperiods;?></code> ครั้ง/ปี.
<br>
ที่มาของเป้าหมาย : <code><?=$model->target_des; ?></code>
ที่มาของผลลัพธ์ : <code><?=$model->goal_des; ?></code>
<br>
งานที่รับผิดชอบ: <code><?=$model->dep->kpi_dep ;?></code> 
ชื่อผู้รับผิดชอบ : <code><?=$model->user_kpi?></code>


</div>

