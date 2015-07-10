<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'预约系统'=>array('index'),
	'添加预约',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>Create Orders</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>