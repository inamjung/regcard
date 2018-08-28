<?php

namespace app\modules\license\controllers;

use Yii;
use app\modules\license\models\ReceiveFinal;
use app\modules\license\models\ReceiveFinalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\base\Model;
use app\modules\license\models\ProvisNation;
use kartik\mpdf\Pdf;
use app\modules\license\models\Receive;
use app\modules\license\models\StoreAt;
use app\modules\license\models\Evidence;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\ReceiveDetailEvidence;
use app\modules\license\models\ReceiveDetailEvidenceNot;


class ReceiveFinalController extends Controller
{

    public function behaviors()
    {
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


    public function actionIndex()
    {    
        $searchModel = new ReceiveFinalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('id desc');
        $dataProvider->query->andWhere(['in', 'status', [2, 3, 4]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
public function actionIndex_() {
        $searchModel = new ReceiveFinalSearch();
        $model = new ReceiveFinal;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->select(' receive_id ,  receive_confirm_id ,  receive_final.user_id 
            ,receive_final.status ,  receive_final.user_id_confirm ,  receive_final.user_id_final,receive_final.store_type_id 
            ,store_area ,  service_fee  ,date_request ,  store_own_dob ,  date_key ,  date_confirm ,  bill_date 
            ,date_book_final ,  evidence ,  evidence_other ,  final_date_start ,  final_date_exp
            ,code_no  ,store_name ,  store_type ,  store_addr ,  store_moo ,  store_tmb ,  store_amp ,  store_chw 
            ,store_phone ,  store_own_pname ,  store_own_fname ,  store_own_lname ,  store_own_age 
            ,store_own_nation ,  evidence_confirm_detail ,  bill_book ,  bill_no 
            ,place_request ,  store_person ,  store_own_addr ,  store_own_moo ,  store_own_tmb 
            ,store_own_amp ,  store_own_chw ,store_own_cid ,store_own_sex ,  evidence_confirm ,  store_area_type ');
        
        $dataProvider->query->joinWith(['nation', 'storetypefinal', 'finalname as u1', 'confirmname as u2', 'statusfinal']);

        $dataProvider->query->orderBy('status asc');
        $dataProvider->query->andFilterWhere(['status.id'=>$searchModel->status]);
        $dataProvider->query->andFilterWhere(['store_type.id'=>$searchModel->store_type_id]);
     
        //$dataProvider->query->andWhere(['in', 'status', [2, 3, 4]]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model'=>$model
        ]);
    }


    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "การออกใบอนุญาต",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    //'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    //        Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new ReceiveFinal();  

        if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "การออกใบอนุญาต",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "การออกใบอนุญาต",
                    'content'=>'<span class="text-success">Create ReceiveFinal success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "การออกใบอนุญาต",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{

            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }


    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "การออกใบอนุญาต",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
             } else if ($model->load($request->post())) {
                $model->user_id_final = Yii::$app->user->identity->id;
                $model->user_id_confirm = Yii::$app->user->identity->id;

                $upat = StoreAt::find()->where(['receive_id' => $model->receive_id])->one();
                $upreceive = Receive::find()->where(['id' => $model->receive_id])->one();

                $upat->status = $model->status;
                $upreceive->status = $model->status;

                $upat->save();
                $upreceive->save();
                $model->save();
                
                return $this->redirect(['index']);
            }else{
                 return [
                    'forceClose'=>'#ajaxCrudModal', 
                    'forceReload'=>'#crud-datatable-pjax',                    
                    'title'=> "การออกใบอนุญาต",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    // 'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    //            Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
 
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }


    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete(['receive_id'=>$id]);        
        $redel = Receive::deleteAll(['id'=> $id]);
        $atdel = StoreAt::deleteAll(['receive_id'=> $id]);
        $evidendel = ReceiveDetailEvidence::deleteAll(['receive_id'=> $id]);
        $evidennotdel = ReceiveDetailEvidenceNot::deleteAll(['receive_id'=> $id]);
        $surveytextdel = SurveyDetailText::deleteAll(['store_at_id'=> $id]);
        $surveytypedel = SurveyDetailType::deleteAll(['store_at_id'=> $id]);    

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing ReceiveFinal model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the ReceiveFinal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReceiveFinal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReceiveFinal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionReportfinal($id) {
        $model = ReceiveFinal::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_report_final', [
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

    public function actionReportconfirm($id) {
        $model = ReceiveFinal::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('_report_confirm', [
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
}
