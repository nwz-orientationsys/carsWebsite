<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs = array('预约中心'=>array('reservation/index'), '添加预约');
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>