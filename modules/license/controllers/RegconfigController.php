<?php

namespace app\modules\license\controllers;

use Yii;
use app\modules\license\models\Regconfig;
use app\modules\license\models\RegconfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\base\Model;
use app\modules\license\models\Thaiaddress;
use yii\web\UploadedFile;

/**
 * RegconfigController implements the CRUD actions for Regconfig model.
 */
class RegconfigController extends Controller {

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
        $searchModel = new RegconfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
                'title' => "หน่วยงานเทศบาล",
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
        $model = new Regconfig();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "หน่วยงานเทศบาล",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $file = UploadedFile::getInstance($model, 'logo_img');
                if (isset($file->size) && $file->size != 0) {
                    $model->logo = $file->name;
                    $file->saveAs('pictures/' . $file->name);
                }
                $model->save();

                return [
                    'forceClose' => '#ajaxCrudModal',
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "หน่วยงานเทศบาล",
                    'content' => '<span class="text-success">Create Regconfig success</span>',
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "หน่วยงานเทศบาล",
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

        if ($request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "หน่วยงานเทศบาล",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $file = UploadedFile::getInstance($model, 'logo_img');
                if (isset($file->size) && $file->size != 0) {
                    $model->logo = $file->name;
                    $file->saveAs('pictures/' . $file->name);
                }
                $model->save();
                
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'forceClose' => '#ajaxCrudModal',
                    'title' => "หน่วยงานเทศบาล",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('<i class="glyphicon glyphicon-off"></i> ปิด', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "หน่วยงานเทศบาล",
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
        if (($model = Regconfig::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddrList($q = null, $id = null) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['addressid' => '', 'text' => '']];
        if (!is_null($q)) {

            $query = new \yii\db\Query();
            $query->select('addressid as id,  full_name AS text')
                    ->from('thaiaddress')
                    ->where(['like', 'full_name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['addressid' => $id, 'text' => Thaiaddress::find($id)->addressid];
        }
        return $out;
    }

}
