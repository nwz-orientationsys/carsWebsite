<?php

class CustomerController extends Controller
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
                        'actions'=>array('index', 'createCar', 'updateCar', 'deleteCar', 'update'),
                        'roles'=>array('customer'),
                ),

                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    
    public function actionView($id)
    {
    	$this->render('view',array(
    			'model'=>$this->loadModel($id),
    	));
    }
    
    public function actionIndex()
    {

        $ordersModel=new Orders('search');
        $ordersModel->unsetAttributes();  // clear any default values
        if(isset($_GET['Orders']))
        	$ordersModel->attributes=$_GET['Orders'];
        $ordersModel->user_id = Yii::app()->user->id;
        
        $carsModel=new Cars('search');
        $carsModel->unsetAttributes();  // clear any default values
        if(isset($_GET['Cars']))
        	$carsModel->attributes=$_GET['Cars'];
        $carsModel->ower_id = Yii::app()->user->id;
        
        $this->render('index',array(
        		'user'=>$this->loadModel(Yii::app()->user->id), 'userid'=>Yii::app()->user->id,
        		'orders'=> $ordersModel,
        		'cars'=>$carsModel,
        ));
    }
    
    public function actionUpdate()
    {
    	$model=$this->loadModel(Yii::app()->user->id);
    	
    	// Uncomment the following line if AJAX validation is needed
    	// $this->performAjaxValidation($model);
    	
    	if(isset($_POST['User']))
    	{
    	
    		$model->attributes=$_POST['User'];
    		$model->type = 'customer';
    		if($model->save())
    			Yii::app ()->user->setFlash('updatesuccess','修改成功');
    		//				$this->redirect(array('view','id'=>$model->id));
    	}
    	
    	$this->render('update',array(
    			'model'=>$model
    	));
    }
    
    public function actionCreateCar()
    {
        $model=new Cars;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['Cars']))
        {
            $model->attributes=$_POST['Cars'];
            $model->ower_id = Yii::app()->user->id;
            if($model->save())
                Yii::app ()->user->setFlash('addsuccess','添加成功');
            //				$this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('car_create',array(
                'model'=>$model,
        ));
    }
    
    public function actionUpdateCar($id)
    {
        $model=$this->loadCarModel($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['Cars']))
        {
            $model->attributes=$_POST['Cars'];
            if($model->save())
                Yii::app ()->user->setFlash('updatesuccess','修改成功');
            //				$this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('car_update',array(
                'model'=>$model,
        ));
    }
    
    public function actionDeleteCar($id)
    {
        $this->loadCarModel($id)->delete();
        
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(array('customer'));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    public function loadCarModel($id)
    {
        $model=Cars::model()->findByPk($id);
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
