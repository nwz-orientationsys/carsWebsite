<?php

class SettingsController extends Controller
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
                        'actions'=>array('index'),
                        'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('carTypes', 'createCarType', 'updateCarType', 'deleteCarType'),
                        'roles'=>array('admin'),//表示只有角色为admin的用户才能访问
                ),

                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    
    public function index()
    {
        
    }
    
    public function actionCarTypes()
    {
        $model=new CarTypes('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['CarTypes']))
            $model->attributes=$_GET['CarTypes'];
        
        $this->render('carTypes',array(
                'carTypes'=>$model,
        ));
    }
    
    public function actionCreateCarType()
    {
        $model=new CarTypes;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['CarTypes']))
        {
        
            $model->attributes=$_POST['CarTypes'];
            if($model->save())
                Yii::app ()->user->setFlash('addsuccess','添加成功');
            //				$this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('carType_create',array(
                'model'=>$model,
        ));
    }
    
    public function actionUpdateCarType($id)
    {
        $model=$this->loadCarTypesModel($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['CarTypes']))
        {
        
            $model->attributes=$_POST['CarTypes'];
            if($model->save())
                Yii::app ()->user->setFlash('updatesuccess','修改成功');
            //				$this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('carType_update',array(
                'model'=>$model,
        ));
    }
    
    public function actionDeleteCarType($id)
    {
        $this->loadCarTypesModel($id)->delete();
        
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(array('settings/carTypes'));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadCarTypesModel($id)
    {
        $model=CarTypes::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
     
     
}
