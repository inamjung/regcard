<?php

namespace app\modules\license\controllers;

use Yii;
use app\modules\license\models\StoreAt;
use app\modules\license\models\StoreAtSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use app\modules\license\models\ProvisNation;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use kartik\mpdf\Pdf;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
use app\modules\license\models\ReceiveFinal;
use app\modules\license\models\Receive;
use yii\helpers\Url;

class StoreAtController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new StoreAtSearch();       
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('id desc');
        $dataProvider->query->filterWhere(['in','status',[1,4]]);


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                  
        ]);
    }

    public function actionMap($cid) {

        $sql = "SELECT s.store_own_cid,CONCAT(s.store_own_pname,s.store_own_fname,'  ',s.store_own_lname) as name
            ,h.HOUSE_ID ,h.VILLAGE,h.TAMBON,h.AMPUR,h.CHANGWAT
            ,h.HOUSE,s.store_name,s.store_addr 
            ,h.LATITUDE as latitude,h.LONGITUDE as longitude
            from store_at s 
            join person p on p.CID=s.store_own_cid
            join home h on CONCAT(p.HOSPCODE,p.HID) = CONCAT(h.HOSPCODE,h.HID)
            where s.store_own_cid='$cid'";
        $connection = Yii::$app->db;
        $data = $connection->createCommand($sql)->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $name[] = $data[$i]['name'];
            $store_addr[] = $data[$i]['store_addr'];
            $store_name[] = $data[$i]['store_name'];
            $latitude[] = $data[$i]['latitude'] * 1;
            $longitude[] = $data[$i]['longitude'] * 1;
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);

        return $this->render('map', [
                    'dataProvider' => $dataProvider,
                    'name' => $name,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'store_name' => $store_name,
                    'store_addr' => $store_addr
                        //'model' => $this->findModel($id),
        ]);
    }


    public function actionView($id) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "บันทึกผลตรวจสถานประกอบกิจการ",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                    //'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionAddItems() {
        $model = new SurveyDetailType();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->store_at_id = Yii::$app->request->post('store_at_id');
            $model->type_id = Yii::$app->request->post('type_id');
            $model->save();
        }
    }

    public function actionAddText() {
        $model = new SurveyDetailText();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->store_at_id = Yii::$app->request->post('store_at_id');
            $model->name = Yii::$app->request->post('name');
            $model->save();
        }
    }

    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new StoreAt();

        if ($request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => '<span class="text-success">Create StoreAt success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('<i class="glyphicon glyphicon-edit"></i> เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //$model->evidence = $model->getArray($model->evidence);
        //$model->evidence_other = $model->getArray($model->evidence_other);

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $updatereceive = Receive::find()->where(['id' => $model->receive_id])->one();
                $tofinal = ReceiveFinal::find()->where(['receive_id' => $model->receive_id])->one();

                $updatereceive->status = $model->status;
                $updatereceive->store_area = $model->store_area;

                $tofinal->code_no = $model->code_no;
                $tofinal->store_name = $model->store_name;
                $tofinal->store_type = $model->store_type;
                $tofinal->store_area = $model->store_area;

                $tofinal->store_addr = $model->store_addr;
                $tofinal->store_moo = $model->store_moo;
                $tofinal->store_tmb = $model->store_tmb;
                $tofinal->store_amp = $model->store_amp;
                $tofinal->store_chw = $model->store_chw;

                $tofinal->store_area_type = $model->store_area_type;
                $tofinal->store_own_addr = $model->store_own_addr;
                $tofinal->store_own_moo = $model->store_own_moo;
                $tofinal->store_own_tmb = $model->store_own_tmb;
                $tofinal->store_own_amp = $model->store_own_amp;
                $tofinal->store_own_chw = $model->store_own_chw;


                $tofinal->store_phone = $model->store_phone;
                $tofinal->date_request = $model->date_request;
                $tofinal->store_own_cid = $model->store_own_cid;
                $tofinal->store_own_pname = $model->store_own_pname;
                $tofinal->store_own_fname = $model->store_own_fname;
                $tofinal->store_own_lname = $model->store_own_lname;
                $tofinal->store_own_dob = $model->store_own_dob;
                $tofinal->store_own_age = $model->store_own_age;
                $tofinal->store_own_sex = $model->store_own_sex;
                $tofinal->store_own_nation = $model->store_own_nation;
                $tofinal->place_request = $model->place_request;
                $tofinal->date_key = $model->date_key;
                $tofinal->status = $model->status;


                $updatereceive->save();
                $tofinal->save();

                $model->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                        //'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "บันทึกผลตรวจสภาพสถานประกอบกิจการ",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($id) {
        $request = Yii::$app->request;
        $this->findModel($id)->delete(['receive_id'=>$id]);        
        $redel = Receive::deleteAll(['id'=> $id]);
        $finaldel = ReceiveFinal::deleteAll(['receive_id'=> $id]);
        $evidendel = ReceiveDetailEvidence::deleteAll(['receive_id'=> $id]);
        $evidennotdel = ReceiveDetailEvidenceNot::deleteAll(['receive_id'=> $id]);
        $surveytextdel = SurveyDetailText::deleteAll(['store_at_id'=> $id]);
        $surveytypedel = SurveyDetailType::deleteAll(['store_at_id'=> $id]);    

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    public function actionBulkDelete() {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = StoreAt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNationList($q = null, $id = null) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['store_own_nation' => '', 'text' => '']];
        if (!is_null($q)) {

            $query = new \yii\db\Query();
            $query->select('code as id,  name AS text')
                    ->from('provis_nation')
                    ->where(['like', 'name', $q])
                    //->where("diagcode LIKE '%".$q."%'")    
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['store_own_nation' => $id, 'text' => ProvisNation::find($id)->store_own_nation];
        }
        return $out;
    }

    public function actionReportat($id) {
        $model = StoreAt::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_report_at', [
            'model' => $model,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            'marginLeft' => 20,
//            'marginRight'=>false,
            'marginTop' => 12,
//            'marginBottom'=>false,
//            'marginHeader'=>false,
//            'marginFooter'=>false,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',            
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => 'ผลการตรวจสถานประกอบกิจการ'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionTomap($cid) {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "SELECT addr.`name` as addrname,addr.full_name
                ,h.HOUSE
                ,h.VILLAGE
                ,h.TAMBON
                ,h.AMPUR
                ,h.CHANGWAT
                ,p.CID as cid
                ,h.LATITUDE
                ,h.LONGITUDE
                ,h.HOUSE_ID
                from home h
                LEFT JOIN person p on CONCAT(p.HOSPCODE,p.HID) = CONCAT(h.HOSPCODE,h.HID)
                LEFT JOIN c_prename pre on pre.id=p.PRENAME
                JOIN receive r on r.store_own_cid=p.CID
                JOIN thaiaddress addr on addr.addressid = CONCAT(h.AMPUR,h.TAMBON)
                where r.store_own_cid='$cid'";
        try {
            $rawData = Yii::$app->db->createCommand($sql)->queryOne();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }
        return[
            'house' => $rawData['HOUSE'].' หมู่ที่ '.$rawData['VILLAGE'].' '.$rawData['full_name'],//บ้านเลขที่
            'village' => $rawData['VILLAGE'],// หมู่ที่
            'tambon' => $rawData['TAMBON'],//ตำบล
            'ampur' => $rawData['AMPUR'],//อำเภอ
            'changwat' => $rawData['CHANGWAT'],//จังหวัด
            'latitude' => $rawData['LATITUDE'],//lat
            'longitude' => $rawData['LONGITUDE'],//lng
            'houseid' => $rawData['HOUSE_ID'],//house_id
        ];
    }

}
