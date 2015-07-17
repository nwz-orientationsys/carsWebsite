<?php

class ReservationController extends Controller
{

    /**
     * @return array action filters
     */
     public function filters()
    {
        return array(
                'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    } 

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
     public function accessRules()
    {
        return array(
                array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array('view'),
                        'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array(
                            
                        ),
                        'roles'=>array('admin'),//表示只有角色为admin的用户才能访问
                ),

                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    } 
    
    /*预约管理列表*/
    public function actionIndex(){
        
        $model = new Orders('search');

        $model->unsetAttributes();  // clear any default values
         if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders']; 

        $this->render('index',array(
                'order'=>$model,
                //'hasType'=>false,
        ));
    }
    
    /**
     * Creates a new model.
     * @param integer $id the default Car Id
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($car=null)
    {

        $model=new Orders('insert');
        if (!empty($car)) $model->car_id = $car;
    
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    
        if(isset($_POST['Orders']))
        {
            $model->attributes=$_POST['Orders'];
            $model->user_id = Yii::app()->user->id;
            if($model->save())
                $this->redirect(array('reservation/index'));
        }
        //$model->car_id = Yii::app()->request->getParam('id');
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    
    
    /*预约修改*/
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
         
        $model=$this->loadModel($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    
        if(isset($_POST['Orders']))
        {
            //检测接线员的id是否为1(是则为未分配)(不是则为已分配)
             if($_POST['Orders']['operator_id']!=1){
                $_POST['Orders']['status']='accepted';
            } 
            
            $model->attributes=$_POST['Orders'];
            if($model->save()){
                $this->redirect(array('index','id'=>$model->id));
            }
        }
        
        $this->render('update',array(
            'model'=>$model,
            'type'=>true,
        ));
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
    
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Orders the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Orders::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

}











