<?php 


use yii\helpers\VarDumper;
use app\models\Users;
class RestController extends Controller{
    
    public $layout='//layouts/rest';
    //获取user列表的方法：
    public function actionList() {
    	$items = User::model()->findAll();
    	if (empty($items)) {
    		$this->_sendResponse(200, 'No users');
    	} else {
    		$rows = array();
    		foreach($items as $item)
    		$rows[] = $item->attributes;
    		$this->_sendResponse(200, CJSON::encode($rows));
    	}
    }
    
    //获取customer列表的方法
    public function actionCusList() {
        $items = Customer::model()->findAll();
        if (empty($items)) {
            $this->_sendResponse(200, 'No customers');
        } else {
            $rows = array();
            foreach($items as $item)
                $rows[] = $item->attributes;
            $this->_sendResponse(200, CJSON::encode($rows));
        }
    }
    
    
    //获取order列表的方法
    public function actionOrderList() {
        $items = Orders::model()->findAll();
        if (empty($items)) {
            $this->_sendResponse(200, 'No orders');
        } else {
            $rows = array();
            foreach($items as $item)
                $rows[] = $item->attributes;
            $this->_sendResponse(200, CJSON::encode($rows));
        }
    }
    
     
    
    //获取某一 user 的方法：
    public function actionView() {
     	if (!isset($_GET['id']))
    		$this->_sendResponse(500, 'user ID is missing');
     	
    	$item = User::model()->findByPk($_GET['id']);
    	
    	if (is_null($item))
    		$this->_sendResponse(404, 'No user found');
    	else
    		$this->_sendResponse(200, CJSON::encode($item)); 
    }
    
    //获取某一 customer 的方法：
    public function actionCusView() {
        if (!isset($_GET['id']))
            $this->_sendResponse(500, 'customer ID is missing');
    
        $item = Customer::model()->findByPk($_GET['id']);
         
        if (is_null($item))
            $this->_sendResponse(404, 'No customer found');
        else
            $this->_sendResponse(200, CJSON::encode($item));
    }
    
    //获取某一 order 的方法：
    public function actionOrderView() {
        if (!isset($_GET['id']))
            $this->_sendResponse(500, 'order ID is missing');
    
        $item = Orders::model()->findByPk($_GET['id']);
         
        if (is_null($item))
            $this->_sendResponse(404, 'No order found');
        else
            $this->_sendResponse(200, CJSON::encode($item));
    }
    
     
    
    //新建一个 user 的方法：
    
    public function actionCreates() {

        $user_model = new User;
        if(isset($_POST['User'])){
            $user_model->attributes = $_POST['User'];
            $user_model->scenario = 'creates';
            if ($user_model->save())
                $this->_sendResponse(200, CJSON::encode($user_model));
            else
                $this->_sendResponse(500, 'Could not Create Item');
        }
        
        $this->render('view',array('user_model'=>$user_model));
    	
    }
    
    
    //新建一个 customer 的方法：
    
    public function actionCusCreates() {
        $this->layout ='//layouts/column3';
        $cus_model = new Customer('insert');
        if(isset($_POST['Customer'])){
            $cus_model->attributes = $_POST['Customer'];
            $cus_model->scenario = 'cuscreates';
            if ($cus_model->save()){
                $this->_sendResponse(200, CJSON::encode($cus_model));
            }    
            else
                $this->_sendResponse(500, 'Could not Create Item');
        }
    
        $this->render('cus_view',array('model'=>$cus_model));
         
    }
    
    //添加车辆
    /* public function actionCarCreates(){
        $this->layout ='//layouts/column3';
        $car_model = new Cars('insert');
        if(isset($_POST['Cars'])){

            $car_model->attributes = $_POST['Cars'];
        
            if ($car_model->save()){
                $this->_sendResponse(200, CJSON::encode($car_model));
            }
            else
                $this->_sendResponse(500, 'Could not Create Item');
        }
        
        $this->render('carcreate',array('model'=>$car_model));
    } */
    
    //新建一个 预约信息 的方法：
    
    public function actionOrderCreates() {
        $this->layout ='//layouts/column3';
        $order_model = new Orders('insert');
        if(isset($_POST['Orders'])){
            //若接线员的id不是1，则将status改为accepted
            if($_POST['Orders']['operator_id']!=1){
                $_POST['Orders']['status']='accepted';
            }

            $order_model->attributes = $_POST['Orders'];
            
            if ($order_model->save()){
                $this->_sendResponse(200, CJSON::encode($order_model));
            }
            else
                $this->_sendResponse(500, 'Could not Create Item');
        }
    
        $this->render('order_view',array('model'=>$order_model));
         
    }
    
     
/*     public function actionIsmd5($password) {
    
        return preg_match("/^[a-z0-9]{32}$/", $password);
    } */
    
    //更新一个 user 的方法：
    
    public function actionUpdate() {
        
    	$this->layout ='//layouts/column3';
        $user_model = User::model();
        //$user_info 才是执行各种方法的实体

       $user_info = $user_model->findByPk($_GET['id']);
        
        
    	 if(isset($_POST['User'])){
    	    $_POST['User']['id']=$_GET['id'];
    	    //密码加密
    	    //如果密码有改动则进行MD5加密
/*     	    if(!$this->Ismd5($_POST['User']['password'])){
    	        $_POST['User']['password']= MD5($_POST['User']['password']);
    	    } */
    	    
    	    $user_info->attributes = $_POST['User'];

    	    if ($user_info->save())
    	        $this->_sendResponse(200, CJSON::encode($user_info));
    	    else
    	        $this->_sendResponse(500, 'Could not Update user');
    	}
    	
    	$this->render('view',array('user_model'=>$user_info,'password3'=>false));
    }
    
    //更新一个 customer 的方法：
    
    public function actionCusUpdate() {
    
        $this->layout ='//layouts/column3';
    
        $cus_model = Customer::model();
        //$user_info 才是执行各种方法的实体
        if(!isset($_GET['id']))
            echo "请输入你想更新的customer的id，例如car.cn/rest/cusupdate/3";
        
        $cus_info = $cus_model->findByPk($_GET['id']);
        
        if(isset($_POST['Customer'])){
            $_POST['Customer']['id']=$_GET['id'];
            $cus_info->attributes = $_POST['Customer'];
    
            if ($cus_info->save())
                $this->_sendResponse(200, CJSON::encode($cus_info));
            else
                $this->_sendResponse(500, 'Could not Update customer');
        }
        $this->render('cus_view',array('user_model'=>$cus_info,'password3'=>false));
        
        
    }
    
    
    //更新一个 Order 的方法：(后台管理员的更新)
    
    public function actionOrderUpdate() {
    
        $this->layout ='//layouts/column3';
    
        $order_model = Orders::model();
        //$user_info 才是执行各种方法的实体
        if(!isset($_GET['id'])){
            echo "请输入你想更新的order的id，例如car.cn/rest/orderupdate/3";
            exit;
        }

        $order_info = $order_model->findByPk($_GET['id']);

         if(isset($_POST['Orders'])){
            
            $_POST['Orders']['id']=$_GET['id'];
            $order_info->attributes = $_POST['Orders'];

            if ($order_info->save())
                $this->_sendResponse(200, CJSON::encode($order_info));
            else
                $this->_sendResponse(500, 'Could not Update customer');
        } 

        $this->render('updateOrder',array('model'=>$order_info));
    }
     
    
    //删除某一 user 的方法：
    
    public function actionDelete() {
    	$item = User::model()->findByPk($_GET['id']);
    	if (is_null)
    		$this->_sendResponse(400, 'No user found');
    	if ($item->delete())
    		$this->_sendResponse(200, 'Delete Success');
    	else
    		$this->_sendResponse(500, 'Could not Delete User');
    }
    
    //删除某一 customer 的方法：
    
    public function actionCusDelete() {
        $item = Customer::model()->findByPk($_GET['id']);
        if (is_null)
            $this->_sendResponse(400, 'No customer found');
        if ($item->delete())
            $this->_sendResponse(200, 'Delete Success');
        else
            $this->_sendResponse(500, 'Could not Delete customer');
    }
    
    //删除某一 order 的方法：
    
    public function actionOrderDelete() {
        $item = Orders::model()->findByPk($_GET['id']);
        if (is_null)
            $this->_sendResponse(400, 'No order found');
        if ($item->delete())
            $this->_sendResponse(200, 'Delete Success');
        else
            $this->_sendResponse(500, 'Could not Delete order');
    }
    
    
    //返回响应的方法：
    
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html') {
    	$status_header = 'HTTP/1.1 '.$status.' '.$this->_getStatusCodeMessage($status);
    	header($status_header);
    	header('Content-type: '.$content_type);
    	echo $body;
    	Yii::app()->end();
    }
    
     
    
    //获取 http 状态码的方法：
    
    private function _getStatusCodeMessage($status) {
    	$codes = Array(
    			200 => 'OK',
    			400 => 'Bad Request',
    			401 => 'Unauthorized',
    			402 => 'Payment Required',
    			403 => 'Forbidden',
    			404 => 'Not Found',
    			500 => 'Internal Server Error',
    			501 => 'Not Implemented', );
    	return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
