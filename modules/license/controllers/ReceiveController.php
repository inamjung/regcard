<?php

namespace app\modules\license\controllers;

use Yii;
use app\modules\license\models\Receive;
use app\modules\license\models\ReceiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\base\Model;
use app\modules\license\models\ProvisNation;
use kartik\mpdf\Pdf;
use app\modules\license\models\ReceiveFinal;
use app\modules\license\models\StoreAt;
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;
use app\modules\license\models\Evidence;
use yii\data\ArrayDataProvider;
use app\modules\license\models\Person;
use app\modules\license\models\Home;
use yii\helpers\Url;
use app\modules\license\models\PersonSearch;
use app\modules\license\models\TbYearNumber;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;

class ReceiveController extends Controller {

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
        $searchModel = new ReceiveSearch();
        $model = new Receive;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->select('receive.id, receive.store_type_id,receive.store_own_nation,receive.status,code_no , store_name ,  store_type ,  store_addr 
                ,  store_moo ,  store_tmb ,  store_amp ,  store_chw ,store_area
                ,  store_phone ,  date_request ,  evidence ,  evidence_other 
                ,  store_own_pname , store_own_fname , store_own_lname ,  store_own_cid , store_own_age  
                ,  date_key , place_request , store_own_dob , store_own_sex , evidence_complete 
                ,  store_own_addr , store_own_moo , store_own_tmb , store_own_amp , store_own_chw , store_area_type,store_area,user_id ');

        $dataProvider->query->joinWith(['storetype', 'nation']);
        $dataProvider->query->orderBy('id desc');
        $dataProvider->query->andFilterWhere(['store_type.id' => $searchModel->storetypes]);
        $dataProvider->query->andFilterWhere(['status' => 1]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
        ]);
    }

    public function actionIndexperson($CID = null) {
        $request = Yii::$app->request; 
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $searchModel = new PersonSearch();
            if ($searchModel->fullName == "") {
                $searchModel->fullName = 'ค้นหา..';
            }
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return [
                'title' => "ค้นหาข้อมูลโดยระบุ ชื่อ หรือ นามสกุล หรือ เลขบัตรประชาชน ตามต้องการ",
                'content' => $this->renderAjax('indexperson', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'CID' => $CID

                ]),
                'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
                    //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }
    }

    public function actionToreceive($CID = null) {

        $sql = "SELECT p.CID,pre.title_th,p.PRENAME as prename,CONCAT(p.`NAME`,' ',p.LNAME) as pername,p.`NAME` as fname,p.LNAME ,addr.`name` as addrname,addr.full_name
                ,h.HOUSE
                ,h.VILLAGE
                ,h.TAMBON
                ,h.AMPUR
                ,h.CHANGWAT,chw.changwatname,amp.ampurname,v.`NAME` as vilname
                ,CONCAT(h.HOUSE,' ',v.`NAME` ,' ',addr.full_name) as ttname
                from home h
                LEFT JOIN person p on CONCAT(p.HOSPCODE,p.HID) = CONCAT(h.HOSPCODE,h.HID)
                LEFT JOIN c_prename pre on pre.id=p.PRENAME               
                JOIN thaiaddress addr on addr.addressid = CONCAT(h.AMPUR,h.TAMBON)
                join cchangwat chw on chw.changwatcode=h.CHANGWAT
                join campur amp on amp.ampurcodefull=h.AMPUR
                join village v on v.id=h.VILLAGE
                where p.CID = '$CID'
";

        try {
            $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE
        ]);

        return $this->render('toreceive', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'CID' => $CID
        ]);
    }

    public function actionAddreceive($ttname = null, $VILLAGE = null, $TAMBON = null, $AMPUR = null, $CHANGWAT = null, $addrname = null, $ampurname = null, $changwatname = null, $CID = null, $title_th = null, $fname = null, $LNAME = null) {

        $c = Receive::find()->count();
        $count = $c + 1;

        $newreceive = new Receive();

        $newreceive->store_addr = $ttname;
        $newreceive->store_moo = $VILLAGE;
        $newreceive->store_tmb = $TAMBON;
        $newreceive->store_amp = $AMPUR;
        $newreceive->store_chw = $CHANGWAT;
        $newreceive->store_own_addr = $ttname;
        $newreceive->store_own_moo = $VILLAGE;
        $newreceive->store_own_tmb = $addrname;
        $newreceive->store_own_amp = $ampurname;
        $newreceive->store_own_chw = $changwatname;
        $newreceive->store_own_cid = $CID;
        $newreceive->store_own_pname = $title_th;
        $newreceive->store_own_fname = $fname;
        $newreceive->store_own_lname = $LNAME;
        $newreceive->date_key = date('Y-m-d');
        $newreceive->user_id = Yii::$app->user->identity->id;
        $newreceive->status = 1;
        $newreceive->code_no = TbYearNumber::find()->where(['status' => 1])->one()->no_number . '/' . $count;
        $newreceive->store_type = '1';
        $newreceive->date_request = date('Y-m-d');
        $newreceive->store_name = '**กรุณาแก้ไขชื่อร้าน';

        if ($newreceive->save()) {
            $newstoreat = new StoreAt();
            $newfinal = new ReceiveFinal();
            
            $newstoreat->receive_id = $newreceive->id;
            $newstoreat->code_no = $newreceive->code_no;
            $newstoreat->store_addr = $ttname;
            $newstoreat->store_moo = $VILLAGE;
            $newstoreat->store_tmb = $TAMBON;
            $newstoreat->store_amp = $AMPUR;
            $newstoreat->store_chw = $CHANGWAT;
            $newstoreat->store_own_addr = $ttname;
            $newstoreat->store_own_moo = $VILLAGE;
            $newstoreat->store_own_tmb = $addrname;
            $newstoreat->store_own_amp = $ampurname;
            $newstoreat->store_own_chw = $changwatname;
            $newstoreat->store_own_cid = $CID;
            $newstoreat->store_own_pname = $title_th;
            $newstoreat->store_own_fname = $fname;
            $newstoreat->store_own_lname = $LNAME;
            $newstoreat->store_person = $newreceive->store_own_fname.' '.$newreceive->store_own_lname;
            $newstoreat->date_key = date('Y-m-d');
            $newstoreat->status = 1;
            $newstoreat->store_type = '1';
            $newstoreat->date_request = date('Y-m-d');
            $newstoreat->store_name = '**กรุณาแก้ไขชื่อร้าน';

            
            $newfinal->receive_id = $newreceive->id;
            $newfinal->code_no = $newreceive->code_no;
            $newfinal->store_addr = $ttname;
            $newfinal->store_moo = $VILLAGE;
            $newfinal->store_tmb = $TAMBON;
            $newfinal->store_amp = $AMPUR;
            $newfinal->store_chw = $CHANGWAT;
            $newfinal->store_own_addr = $ttname;
            $newfinal->store_own_moo = $VILLAGE;
            $newfinal->store_own_tmb = $addrname;
            $newfinal->store_own_amp = $ampurname;
            $newfinal->store_own_chw = $changwatname;
            $newfinal->store_own_cid = $CID;
            $newfinal->store_own_pname = $title_th;
            $newfinal->store_own_fname = $fname;
            $newfinal->store_own_lname = $LNAME;
            $newfinal->store_person = $newreceive->store_own_fname.' '.$newreceive->store_own_lname;
            $newfinal->date_key = date('Y-m-d');
            $newfinal->status = 1;            
            $newfinal->store_type = '1';
            $newfinal->date_request = date('Y-m-d');
            $newfinal->store_name = '**กรุณาแก้ไขชื่อร้าน';

            $newfinal->save();
            $newstoreat->save();
            return $this->redirect(['receive/index']);
        }
    }

    public function actionView($id) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                    //'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                    //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionView1() {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "ข้อมูลที่อยู่",
                'content' => $this->renderAjax('storeaddr', [
                        //'model' => $this->findModel($id),
                ]),
                    //'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                    //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionAddEvidence() {
        $model = new ReceiveDetailEvidence();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->receive_id = Yii::$app->request->post('receive_id');
            $model->evidence_id = Yii::$app->request->post('evidence_id');
            $model->save();
        }
    }

    public function actionAddEvidenceNot() {
        $model = new ReceiveDetailEvidenceNot();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->receive_id = Yii::$app->request->post('receive_id');
            $model->evidence_id = Yii::$app->request->post('evidence1_id');
            $model->save();
        }
    }

    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Receive();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    //Html::button('<i class="glyphicon glyphicon-ok"></i> ข้อมูลบัตรประชาชน',['class'=>'btn btn-success','type'=>"",'onClick' => 'return loadSmartCard();']).            
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $model->date_key = date('Y-m-d');
                $model->user_id = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $confirm = new ReceiveFinal();
                    $survey = new StoreAt();

                    $confirm->receive_id = $model->id;
                    $confirm->code_no = $model->code_no;
                    $confirm->store_name = $model->store_name;
                    $confirm->store_type = $model->store_type;
                    $confirm->store_area = $model->store_area;

                    $confirm->store_area_type = $model->store_area_type;
                    $confirm->store_own_addr = $model->store_own_addr;
                    $confirm->store_own_moo = $model->store_own_moo;
                    $confirm->store_own_tmb = $model->store_own_tmb;
                    $confirm->store_own_amp = $model->store_own_amp;
                    $confirm->store_own_chw = $model->store_own_chw;


                    $confirm->store_addr = $model->store_addr;
                    $confirm->store_moo = $model->store_moo;
                    $confirm->store_tmb = $model->store_tmb;
                    $confirm->store_amp = $model->store_amp;
                    $confirm->store_chw = $model->store_chw;

                    $confirm->store_phone = $model->store_phone;
                    $confirm->date_request = $model->date_request;
                    $confirm->store_own_cid = $model->store_own_cid;
                    $confirm->store_own_pname = $model->store_own_pname;
                    $confirm->store_own_fname = $model->store_own_fname;
                    $confirm->store_own_lname = $model->store_own_lname;
                    $confirm->store_person = $model->store_own_pname . $model->store_own_fname . '  ' . $model->store_own_lname;
                    $confirm->store_own_dob = $model->store_own_dob;
                    $confirm->store_own_age = $model->store_own_age;
                    $confirm->store_own_sex = $model->store_own_sex;
                    $confirm->store_own_nation = $model->store_own_nation;
                    $confirm->place_request = $model->place_request;
                    $confirm->date_key = $model->date_key;
                    $confirm->status = $model->status;
                    $confirm->store_type_id = $model->store_type_id;
                    //$confirm->date_book_final = date('Y-m-d');
                    //$confirm->user_id = $model->user_id;
                    //$confirm->user_id_final = Yii::$app->user->identity->id;


                    $survey->receive_id = $model->id;
                    $survey->code_no = $model->code_no;
                    $survey->store_name = $model->store_name;
                    $survey->store_type = $model->store_type;
                    $survey->store_area = $model->store_area;

                    $survey->store_addr = $model->store_addr;
                    $survey->store_moo = $model->store_moo;
                    $survey->store_tmb = $model->store_tmb;
                    $survey->store_amp = $model->store_amp;
                    $survey->store_chw = $model->store_chw;

                    $survey->store_area_type = $model->store_area_type;
                    $survey->store_own_addr = $model->store_own_addr;
                    $survey->store_own_moo = $model->store_own_moo;
                    $survey->store_own_tmb = $model->store_own_tmb;
                    $survey->store_own_amp = $model->store_own_amp;
                    $survey->store_own_chw = $model->store_own_chw;

                    $survey->store_phone = $model->store_phone;
                    $survey->date_request = $model->date_request;
                    $survey->store_own_cid = $model->store_own_cid;
                    $survey->store_own_pname = $model->store_own_pname;
                    $survey->store_own_fname = $model->store_own_fname;
                    $survey->store_own_lname = $model->store_own_lname;
                    $survey->store_person = $model->store_own_pname . $model->store_own_fname . '  ' . $model->store_own_lname;
                    $survey->store_own_dob = $model->store_own_dob;
                    $survey->store_own_age = $model->store_own_age;
                    $survey->store_own_sex = $model->store_own_sex;
                    $survey->store_own_nation = $model->store_own_nation;
                    $survey->place_request = $model->place_request;
                    $survey->date_key = $model->date_key;
                    $survey->status = $model->status;
                    $survey->store_type_id = $model->store_type_id;
                    //$survey->user_id = $model->user_id;
                    //$confirm->user_id_final = Yii::$app->user->identity->id;

                    $confirm->save();
                    $survey->save();
                }

                ;
                return [
                    //'forceClose'=>'#ajaxCrudModal',
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => '<span class="text-success">นำเข้าข้อมูลผู้ยื่นแบบคำขอแล้ว</span>',
                    'footer' =>
                    //Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                    Html::a('<i class="glyphicon glyphicon-edit"></i> ตรวจเอกสาร/หลักฐาน', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' =>
                    Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {

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

        $model->evidence = $model->getArray($model->evidence);
        $model->evidence_other = $model->getArray($model->evidence_other);

        if ($request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    //Html::button('<i class="glyphicon glyphicon-ok"></i> อับเดทข้อมูลบัตรประชาชน',['class'=>'btn btn-info','type'=>"",'onClick' => 'return loadSmartCard();']). 
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $model->user_id = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $at = StoreAt::find()->where(['receive_id' => $model->id])->one();
                    $final = ReceiveFinal::find()->where(['receive_id' => $model->id])->one();

                    $at->receive_id = $model->id;
                    $at->code_no = $model->code_no;
                    $at->store_name = $model->store_name;
                    $at->store_type = $model->store_type;
                    $at->store_area = $model->store_area;

                    $at->store_addr = $model->store_addr;
                    $at->store_moo = $model->store_moo;
                    $at->store_tmb = $model->store_tmb;
                    $at->store_amp = $model->store_amp;
                    $at->store_chw = $model->store_chw;

                    $at->store_area_type = $model->store_area_type;
                    $at->store_own_addr = $model->store_own_addr;
                    $at->store_own_moo = $model->store_own_moo;
                    $at->store_own_tmb = $model->store_own_tmb;
                    $at->store_own_amp = $model->store_own_amp;
                    $at->store_own_chw = $model->store_own_chw;

                    $at->store_phone = $model->store_phone;
                    $at->date_request = $model->date_request;
                    $at->evidence = $model->evidence;
                    $at->evidence_other = $model->evidence_other;
                    $at->store_own_cid = $model->store_own_cid;
                    $at->store_own_pname = $model->store_own_pname;
                    $at->store_own_fname = $model->store_own_fname;
                    $at->store_own_lname = $model->store_own_lname;
                    $at->store_own_dob = $model->store_own_dob;
                    $at->store_own_age = $model->store_own_age;
                    $at->store_own_sex = $model->store_own_sex;
                    $at->store_own_nation = $model->store_own_nation;
                    $at->place_request = $model->place_request;
                    $at->date_key = $model->date_key;
                    $at->status = $model->status;
                    $at->store_type_id = $model->store_type_id;
                    //$survey->user_id = $model->user_id;
                    //$confirm->user_id_final = Yii::$app->user->identity->id;



                    $final->receive_id = $model->id;
                    $final->code_no = $model->code_no;
                    $final->store_name = $model->store_name;
                    $final->store_type = $model->store_type;
                    $final->store_area = $model->store_area;

                    $final->store_addr = $model->store_addr;
                    $final->store_moo = $model->store_moo;
                    $final->store_tmb = $model->store_tmb;
                    $final->store_amp = $model->store_amp;
                    $final->store_chw = $model->store_chw;

                    $final->store_area_type = $model->store_area_type;
                    $final->store_own_addr = $model->store_own_addr;
                    $final->store_own_moo = $model->store_own_moo;
                    $final->store_own_tmb = $model->store_own_tmb;
                    $final->store_own_amp = $model->store_own_amp;
                    $final->store_own_chw = $model->store_own_chw;

                    $final->store_phone = $model->store_phone;
                    $final->date_request = $model->date_request;
                    $final->store_own_cid = $model->store_own_cid;
                    $final->store_own_pname = $model->store_own_pname;
                    $final->store_own_fname = $model->store_own_fname;
                    $final->store_own_lname = $model->store_own_lname;
                    $final->store_own_dob = $model->store_own_dob;
                    $final->store_own_age = $model->store_own_age;
                    $final->store_own_sex = $model->store_own_sex;
                    $final->store_own_nation = $model->store_own_nation;
                    $final->place_request = $model->place_request;
                    $final->date_key = $model->date_key;
                    $final->status = $model->status;
                    $final->store_type_id = $model->store_type_id;

                    $final->save();
                    $at->save();
                }
                return [
                    //'forceClose'=>'#ajaxCrudModal',
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
//                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            } else {
                return [
                    'title' => "แบบคำขอรับใบอนุญาต/ต่อใบอนุญาต",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {

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
        $this->findModel($id)->delete();
        $atdel = StoreAt::deleteAll(['receive_id'=> $id]);
        $finaldel = ReceiveFinal::deleteAll(['receive_id'=> $id]);
        $evidendel = ReceiveDetailEvidence::deleteAll(['receive_id'=> $id]);
        $evidennotdel = ReceiveDetailEvidenceNot::deleteAll(['receive_id'=> $id]);
        $surveytextdel = SurveyDetailText::deleteAll(['store_at_id'=> $id]);
        $surveytypedel = SurveyDetailType::deleteAll(['store_at_id'=> $id]);      

        if ($request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {

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

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {

            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Receive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAge($birthday) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $then = strtotime($birthday);

        return [
            'age' => floor((time() - $then) / 31556926),
        ];
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

    public function actionReport01($id) {
        $model = Receive::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_report01', [
            'model' => $model,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            'marginLeft' => 25,
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
            'options' => ['title' => 'แบบคำขอรับใบอนุญาต/ต่ออายุใบอนุญาต'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionReport02($id) {
        $model = Receive::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_report02', [
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
            'options' => ['title' => 'หนังสือรับรองการแจ้ง'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionForm03($id) {
        $model = Receive::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_form03', [
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
            'options' => ['title' => 'ใบอนุญาต'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionRequrest01() {
        $model = Receive::find()->one();
        $content = $this->renderPartial('_requrest01', [
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
            'options' => ['title' => 'แบบคำขอแจ้ง'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionRequrest02() {
        $model = Receive::find()->one();
        $content = $this->renderPartial('_requrest02', [
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
            'options' => ['title' => 'แบบคำขอรับใบอนุญาต/ต่ออายุใบอนุญาต'],
            'methods' => [
            ]
        ]);
        return $pdf->render();
    }

    public function actionTohome($cid) {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "SELECT addr.`name` as addrname,addr.full_name
                ,h.HOUSE
                ,h.VILLAGE
                ,h.TAMBON
                ,h.AMPUR
                ,h.CHANGWAT
                ,p.CID as cid
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
//        $dataProvider = new ArrayDataProvider([
//                'allModels'=>$rawData, 
//                'sort'=> !empty($cols) ? ['attributes'=> $cols] : FALSE,
//                'pagination'=>FALSE
//            ]);
//        
//        return $this->render('tohome',[
//            'dataProvider' => $dataProvider,
//            'rawData'=>$rawData,
//            'sql' => $sql,
//            'cid'=>$cid
//        ]);

        return[
            'house' => $rawData['HOUSE'] . ' หมู่ที่ ' . $rawData['VILLAGE'] . ' ' . $rawData['full_name'], //บ้านเลขที่
            'village' => $rawData['VILLAGE'], // หมู่ที่
            'tambon' => $rawData['TAMBON'], //ตำบล
            'ampur' => $rawData['AMPUR'], //อำเภอ
            'changwat' => $rawData['CHANGWAT']//จังหวัด
        ];
//        print_r($rawData);
    }

    public function actionPersontohome($cid) {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "SELECT addr.`name` as addrname,addr.full_name
                ,h.HOUSE
                ,h.VILLAGE
                ,h.TAMBON
                ,h.AMPUR
                ,h.CHANGWAT,chw.changwatname,amp.ampurname,v.`NAME` as vilname
                ,p.CID as cid
                from home h
                LEFT JOIN person p on CONCAT(p.HOSPCODE,p.HID) = CONCAT(h.HOSPCODE,h.HID)
                LEFT JOIN c_prename pre on pre.id=p.PRENAME
                JOIN receive r on r.store_own_cid=p.CID
                JOIN thaiaddress addr on addr.addressid = CONCAT(h.AMPUR,h.TAMBON)
                join cchangwat chw on chw.changwatcode=h.CHANGWAT
                join campur amp on amp.ampurcodefull=h.AMPUR
                join village v on v.id=h.VILLAGE
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
            'house' => $rawData['HOUSE'] . ' หมู่ที่ ' . $rawData['VILLAGE'] . ' ' . $rawData['full_name'], //บ้านเลขที่
            'village' => $rawData['VILLAGE'], // หมู่ที่
            'tambon' => $rawData['TAMBON'], //ตำบล
            'ampur' => $rawData['AMPUR'], //อำเภอ
            'changwat' => $rawData['CHANGWAT'], //จังหวัด
            'village' => $rawData['VILLAGE'], // หมู่ที่
            'tambon' => $rawData['TAMBON'], //ตำบล
            'ampur' => $rawData['AMPUR'], //อำเภอ
            'changwat' => $rawData['CHANGWAT']//จังหวัด    
        ];
//        print_r($rawData);
    }

}
