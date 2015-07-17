<div class="content">
	<div class="header">
		<h1 class="page-title">预约中心</h1>
	</div>
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links' => array(
            '预约中心' => array(
                'index'
            ),
            '预约列表'
        )
    ));
    ?>
    <div class="container-fluid">
		<div class="row-fluid">

			<div class="btn-toolbar">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '添加预约',
                    'type' => 'primary',
                    'url' => '/reservation/create',
                    'icon' => 'plus'
                ));
                ?>
            </div>
            <!-- gjadjf -->
			<div class="well">
                 <?php
                
                $columns = array(
                    array(
                        'name' => 'car_licenseNumber',
                        'type' => 'html',
                        'value' => '$data->licenseNumber->licenseNumber'
                    ),
                    'date',
                    'time',
                    'comment',
                    array(
                        'name' => 'status',
                        'type' => 'html',
                        'value' => 'Orders::getStatusName($data->status)'
                    ),
                    array(
                        'name' => 'operator_name',
                        'type' => 'html',
                        'value' => '$data->operator->id != 1 ? $data->operator->name : ""'
                    )
                );
                array_push($columns, array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'deleteConfirmation' => '确认删除此条记录？',
                    
                    'buttons' => array(
                        'update' => array(
                            'visible' => '$data->status=="pending"',
                            'url' => 'Yii::app()->createUrl("reservation/update", array("id"=>$data->id))'
                        )
                    ),
                    
                    'deleteButtonUrl' => 'Yii::app()->createUrl("reservation/delete", array("id"=>$data->id))',
                    'template' => '{update}{delete}'
                ));
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'order-grid',
                    'dataProvider' => $order->search(),
                    'filter' => $order,
                    'columns' => $columns
                ));
                ?> 
			</div>
		</div>
	</div>
</div>
