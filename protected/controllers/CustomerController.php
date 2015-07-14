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
                        'actions'=>array('index', 'createCar', 'updateCar', 'deleteCar'),
                        'users'=>array('*'),
                ),

                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    
    public function actionIndex()
    {

        $model=new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Orders']))
        	$model->attributes=$_GET['Orders'];
        $model->user_id = Yii::app()->user->id;
        
        $dataProvider=new CActiveDataProvider('Orders');
        
        $model1=new Cars('search');
        $model1->unsetAttributes();  // clear any default values
        if(isset($_GET['Cars']))
        	$model1->attributes=$_GET['Cars'];
        $model1->ower_id = Yii::app()->user->id;
        
        $dataProvider1=new CActiveDataProvider('Cars');
        
        $this->render('index',array(
        		'user'=>$this->loadModel(Yii::app()->user->id), 'userid'=>Yii::app()->user->id,
        		'orders'=> $model,
        		'dataProvider'=>array($dataProvider,$dataProvider1),
        		'cars'=>$model1,
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
