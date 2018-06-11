<?php
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\editable\Editable;
use app\modules\kpi\models\Kpidata;
?>
<style>
.modal.in .modal-dialog {
            width: 80%;
        }
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
<?php
echo $this->render('@app/modules/kpi/views/kpidata/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'model' => $model
]);
?>