<?php

namespace app\modules\license\controllers;

use Yii;
use app\modules\license\models\Home;
use app\modules\license\models\HomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\base\Model;
use app\modules\license\models\Cchangwat;
use app\modules\license\models\Campur;
use app\modules\license\models\Ctambon;
use kartik\widgets\DepDrop;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\modules\license\models\Person;

class HomeController extends Controller {

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
        $searchModel = new HomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('id desc');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "ทะเบียนครัวเรือน",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Home();
        
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "ทะเบียนครัวเรือน",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
//                $i = "1";
//                $fhid = Home::find()->max("HID")+$i;
//                $model->HID = $fhid ;
              
                $model->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "ทะเบียนครัวเรือน",
                    'content' => '<span class="text-success">Create Home success</span>',
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('<i class="glyphicon glyphicon-edit"></i> เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "ทะเบียนครัวเรือน",
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
    
    public function actionAddPerson() {
        $model = new Person();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->HID = Yii::$app->request->post('HID');
            $model->CID = Yii::$app->request->post('CID');
            $model->PRENAME = Yii::$app->request->post('PRENAME');
            $model->NAME = Yii::$app->request->post('NAME');
            $model->LNAME = Yii::$app->request->post('LNAME');
            $model->SEX = Yii::$app->request->post('SEX');
            $model->BIRTH = Yii::$app->request->post('BIRTH');
            $model->NATION = Yii::$app->request->post('NATION');
            $model->PASSPORT = Yii::$app->request->post('PASSPORT');
            $model->TYPEAREA = Yii::$app->request->post('TYPEAREA');
            $model->save();
        }
    }


    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $amphur = ArrayHelper::map($this->getAmphur($model->CHANGWAT), 'id', 'name');
        $district = ArrayHelper::map($this->getDistrict($model->AMPUR), 'id', 'name');

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "ทะเบียนครัวเรือน",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'amphur' => $amphur,
                        'district' => $district
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' =>"ทะเบียนครัวเรือน",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'amphur' => $amphur,
                        'district' => $district
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "ทะเบียนครัวเรือน",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'amphur' => $amphur,
                        'district' => $district
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
                            'amphur' => $amphur,
                            'district' => $district
                ]);
            }
        }
    }


    public function actionDelete($id) {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

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
        if (($model = Home::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getDistrict($amphur_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getAmphur($id) {
        $datas = Campur::find()->where(['changwatcode' => $id])->all();
        return $this->MapData($datas, 'ampurcodefull', 'ampurname');
    }

    protected function getDistrict($id) {
        $datas = Ctambon::find()->where(['ampurcode' => $id])->all();
        return $this->MapData($datas, 'tamboncode', 'tambonname');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

}
