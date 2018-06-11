<?php

namespace app\modules\kpi\controllers;

use Yii;
use app\modules\kpi\models\Kpi;
use app\modules\kpi\models\KpiSearch;
use app\modules\kpi\models\Kpidata;
use app\modules\kpi\models\KpidataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;

/**
 * KpiController implements the CRUD actions for Kpi model.
 */
class KpiController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Kpi models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new KpiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Kpi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView_($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kpi #".$id,
                    'content'=>$this->renderAjax('view_', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                            //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view_', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    public function actionViewdocs($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ดาวโหลดเอกสาร #".$id,
                    'content'=>$this->renderAjax('viewdocs', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                            //Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('viewdocs', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    public function actionView($id)
    {   
      $searchModel_data = new KpidataSearch();
      $dataProvider_data = $searchModel_data->search(Yii::$app->request->queryParams);
      $dataProvider_data->query->andWhere(['kpi_id' => $id]);
      $dataProvider_data->query->orderBy(['frequency_no'=> SORT_ASC]);
      // EditTable
      $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
              'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<i class='glyphicon glyphicon-search'></i>รอบความถี่ในการบันทึกตัวชี้วัด #".$id,
                    'content'=>$this->renderAjax('view', [
                      'searchModel' => $searchModel_data,
                      'dataProvider' => $dataProvider_data,
                      'model' => $this->findModel($id),
                    ]),
//                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
              'searchModel' => $searchModel_data,
              'dataProvider' => $dataProvider_data,
              //'dataProvider' => $dataProvider,  
              'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Kpi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Kpi();  
        $model_data = new Kpidata();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "สร้างตัวชี้วัดใหม่ **โปรดกรอกข้อมูลช่องสีแดงให้ครบถ้วน โปรแกรมจึงบันทึกได้",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'model_data'=> $model_data
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
               
                
                //$model->kpiname = $model->items->kpiname;
                //$model->kpidesc = $model->items->kpidesc;                
                $model->statuskpi = 1;
                $model->useradd_id = Yii::$app->user->identity->id;
                $model->d_add = date('Y-m-d');
                $model->docs = $this->uploadMultipleFile($model);
                
                //$this->CreateDir($model->ref); 
                $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
                
                  if ($model->save()) {
                      $n = 1;
                      //for($i=0;$i<=$model->periods->period -1;$i++)
                       for($i=0;$i<=$model->dperiods -1;$i++)
                       {
                          $kdata = new Kpidata();
                          $kdata->kpi_id = $model->id;
                          $kdata->denom = $model->denom;
                          $kdata->devide = $model->devide;
                          $kdata->goal = $model->goal;
                          $kdata->target = $model->target;
                          $kdata->target_des = $model->target_des;
                          $kdata->user_id_result = Yii::$app->user->identity->id;
                          $kdata->d_add = date('Y-m-d');
                          //
                          $day = $model->dtotal * $i;//
                          $date =  $model->d_begin_year;
                          $kdata->d_end_result = date ("Y-m-d", strtotime(+$day."day", strtotime($date)));
                          //
                         
                          $kdata->frequency_no = $i + 1;
                          
                          //    นับจำนวนวันถัดไป
                        $next_day = $model->dtotal * $n++;
                           // คำนวนวันที่สุดท้ายของ next_date
                          $row =  ($n - 1);
                           if ($row == $model->dperiods) {
                               $kdata->d_end_result = date ("Y-m-d", strtotime(+$next_day."day", strtotime($date)));
                           }
                           else{
                              $kdata->d_end_result = date ("Y-m-d", strtotime(+$next_day."day", strtotime($date)));
                           }
                           
                           $kdata->save();
                      }
                      
                  }
                  
//                return [
//                    'forceReload'=>'#crud-datatable-pjax',
//                    'forceClose'=>true,
//                    'title'=> "Create new Kpi",
//                    'content'=>'<span class="text-success">Create Kpi success</span>',
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
//        
//                ];   
                   Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{           
                return [
                    'title'=> "Create new Kpi",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'model_data'=> $model_data
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                
                //$this->CreateDir($model->ref); 
                 $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'model_data'=> $model_data
                ]);
            }
        }
       
    }
  
    /**
     * Updates an existing Kpi model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);    
        
        $tempDocs     = $model->docs;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "แก้ไขข้อมูล kpi #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                   //     'model_data'=> $model_data
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-off"></i> ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('<i class="glyphicon glyphicon-ok"></i> บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                //$this->CreateDir($model->ref);  
                $model->docs = $this->uploadMultipleFile($model,$tempDocs);
                
                //$model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
                $model->save();
//                return [
//                    'forceReload'=>'#crud-datatable-pjax',
//                    'title'=> "Kpi #".$id,
//                    'content'=>$this->renderAjax('view', [
//                        'model' => $model,
//                        'model_data'=> $model_data
//                    ]),
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
//                ];   
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                 return [
                    'title'=> "แก้ไขข้อมูล kpi #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'model_data'=> $model_data
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'model_data'=> $model_data
                ]);
            }
        }
    }

    /**
     * Delete an existing Kpi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $request = Yii::$app->request;
        $this->findModel($id)->delete();
        $deldata = Kpidata::deleteAll(['kpi_id'=>$id]);

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
     * Delete multiple existing Kpi model.
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
     * Finds the Kpi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kpi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kpi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // upload file
    public function actionDeletefile($id,$field,$fileName){
        $status = ['success'=>false];
        if(in_array($field, ['docs'])){
            $model = $this->findModel($id);
            $files =  Json::decode($model->{$field});
            if(array_key_exists($fileName, $files)){
                if($this->deleteFile('file',$model->ref,$fileName)){
                    $status = ['success'=>true];
                    unset($files[$fileName]);
                    $model->{$field} = Json::encode($files);
                    $model->save();
                }
            }
        }
        echo json_encode($status);
    }

    private function deleteFile($type='file',$ref,$fileName){
        if(in_array($type, ['file','thumbnail'])){
            if($type==='file'){
               $filePath = Kpi::getUploadPath().$ref.'/'.$fileName;
            } else {
               $filePath = Kpi::getUploadPath().$ref.'/thumbnail/'.$fileName;
            }
            @unlink($filePath);
            return true;
        }
        else{
            return false;
        }
    }

    public function actionDownload($id,$file,$file_name){
        $model = $this->findModel($id);
        //if(!empty($model->ref) && !empty($model->docs)){
         if(!empty($model->docs)){
                Yii::$app->response->sendFile($model->getUploadPath().'/'.$file,$file_name);
                //Yii::$app->response->sendFile($model->getUploadPath().'/'.$model->ref.'/'.$file,$file_name);
        }else{
            $this->redirect(['/kpi/kpi/view','id'=>$id]);
        }
    }
    

    private function uploadMultipleFile($model,$tempFile=null){
             $files = [];
             $json = '';
             $tempFile = Json::decode($tempFile);
             $UploadedFiles = UploadedFile::getInstances($model,'docs');
             if($UploadedFiles!==null){
                foreach ($UploadedFiles as $file) {
                    try {   $oldFileName = $file->basename.'.'.$file->extension;
                            $newFileName = md5($file->basename.time()).'.'.$file->extension;
                            $file->saveAs(Kpi::UPLOAD_FOLDER.'/'.$newFileName);
                            // $file->saveAs(Kpi::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                            $files[$newFileName] = $oldFileName ;
                    } catch (Exception $e) {
                       
                    }
                }
                $json = json::encode(ArrayHelper::merge($tempFile,$files));
             }else{
                $json = $tempFile;
             }          
            return $json;
    }
//    private function CreateDir($folderName){
//        if($folderName != NULL){
//            $basePath = Kpi::getUploadPath();
//            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
//                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
//            }
//        }
//        return;
//    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Kpi::getUploadPath().$dir);
    }
}
