<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'预约系统',
);

$this->menu=array(
	array('label'=>'Create Orders', 'url'=>array('create')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>Orders</h1>

<div class="well">
<?php

$columns = array(array('name'=>'user_id','type'=>'html','value'=>'$data->applicant->name'), 'date', 'time', 'comment');
//if ($hasType) array_push($columns, 'type');

array_push($columns, array('class'=>'bootstrap.widgets.TbButtonColumn', 'deleteConfirmation'=>'确认删除此条记录？', 'template' => '{view}{update}{delete}'));

$this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'order-grid',
		'dataProvider' => $orders->search(),
		'filter' => $orders,
		'columns' => $columns,
));
?>
