<?php
/* @var $this SiteController */
$this->pageTitle='首页';
$day = array(
		'日','一','二','三','四','五','六',
);
$new_customer_num = User::model()->count('DATE(created)>=:today AND type="customer"',array(':today'=>date('Y-m-d')));
$subscribe_num = Orders::model()->count( 'DATE(created) >= :today', array(':today'=>date('Y-m-d')) );
?>
<div class="content">
    <div class="header">
        <h1 class="page-title"><?php echo $this->pageTitle?></h1>
    </div>
    <div class="container-fluid">
        <div class="btn-toolbar">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => '修改个人信息',
                'type' => 'primary',
                'url' => array('user/update', 'id' => $operatorid),
                'icon' => 'pencil'
            ));
            ?>
	    </div>  
        <div class="well">        		
        	    <?php 
                $columns = array(
                		array(
                			'name'=>'name',
                			'type'=>'html',
                			'value'=>'Chtml::link($data->name,array("user/view","id"=>$data->id))'
                		), 
                		'email', 
                		'phone',
                );
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'operator-grid',
                	'dataProvider' => $operator->search(),
                	'columns' => $columns,
                ));
                ?>	
	    </div>
	    <div class="well">
                <?php
                echo '添加任务';
                $columns1 = array(
                		//'id',
                		array(
                			'name'=>'user_id', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->name',
               			),
                		array(
                			'name'=>'车主电话', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->phone',
               			),
                		array(
                			'name'=>'车辆牌照',
                			'type'=>'html',
                			'value'=>'$data->licenseNumber->licenseNumber'
                        ),
                		/*
                		array(
                			'name'=>'operator_id',
                			'type'=>'html',
                			'value'=>'$data->operator->name'
                        ),
                        */
                		'date',
                		'time',
                		'comment',
                );
                
                array_push($columns1, array(
                		'class'=>'bootstrap.widgets.TbButtonColumn',
                		'buttons'=>array(
                				'confirm'=>array(
                						'label'=>'确认',
                						//'visible'=>'$data->status=="pending"',
                						'url'=>'Yii::app()->createUrl("orders/operatorConfirm", array("id"=>$data->id))',
                				),
                		),
                		'template' => '{confirm}'
                ));
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'confirm-order-grid',
                    'dataProvider' => $orders->search(),
                    //'filter' => $orders,
                    'columns' => $columns1,
                ));
                ?>	
	    </div>
	    <div class="well">
                <?php
                echo '取消任务';
                $columns2 = array(
                		//'id',
                		array(
                			'name'=>'user_id', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->name',
               			),
                		array(
                			'name'=>'车主电话', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->phone',
               			),
                		array(
                			'name'=>'车辆牌照',
                			'type'=>'html',
                			'value'=>'$data->licenseNumber->licenseNumber'
                        ),
                		/*
                		array(
                			'name'=>'operator_id',
                			'type'=>'html',
                			'value'=>'$data->operator->name'
                        ),
                        */
                
                		'date',
                		'time',
                		'comment',
                );
                
                array_push($columns2, array(
                		'class'=>'bootstrap.widgets.TbButtonColumn',
                		'buttons'=>array(
                				'cancle'=>array(
                						'label'=>'取消',
                						//'visible'=>'$data->status=="pending"',
                						'url'=>'Yii::app()->createUrl("orders/operatorCancel", array("id"=>$data->id))',
                				),
                		),
                		'template' => '{cancle}'
                ));
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'cancle-order-grid',
                    'dataProvider' => $acceptedOrders->search(),
                    //'filter' => $orders,
                    'columns' => $columns2,
                ));
                
                ?>	
	    </div>
	</div>
</div>