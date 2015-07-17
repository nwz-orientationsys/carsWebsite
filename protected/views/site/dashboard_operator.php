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
                'label' => '修改信息',
                'type' => 'primary',
                'url' => array('user/update'),
                'icon' => 'pencil'
            ));
            ?>
		</div>
        <div class="well">        		
        	    <?php 

                $this->widget('bootstrap.widgets.TbDetailView', array(
                		'id' => 'operator-grid',
                		'type' => 'horizontal',
                		'data' => $operator,
                		'attributes' => array(
                				'name',
                				'email',
                				'phone',
                		),
                ));
                ?>	
	    </div>
	    <div class="well">
                <?php
                echo '我的任务';
                $columns2 = array(
                		//'id',
                		array(
                			'name'=>'owner_name', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->name',
               			),
                		array(
                			'name'=>'applicant.phone', 
                			'type'=>'html', 
                			'value'=>'$data->applicant->phone',
               			),
                		array(
                			'name'=>'licenseNumber.licenseNumber',
                			'type'=>'html',
                			'value'=>'$data->licenseNumber->licenseNumber',
                        ),
                        'date',
                		'time',
                		'comment',
                );
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'order-grid',
                    'dataProvider' => $acceptedOrders->search(),
                    'filter' => $acceptedOrders,
                    'columns' => $columns2,
                ));
                
                ?>	
	    </div>
	</div>
</div>