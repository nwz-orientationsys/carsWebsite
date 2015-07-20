

<div class="well" style="border: 0px solid #CCC;">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => '我要预约',
        'type' => 'primary',
        'url' => array('Orders/create', 'id' => $userid),
        'icon' => 'pencil',
        'size' => 'large'
    ));
    ?>

</div>
<div class="container-fluid">
    <div class="well">
    <h2><span>我的个人信息</span></h2>
        <div class="btn-toolbar">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => '修改',
                'type' => 'primary',
                'url' => array('customer/update', 'id' => $userid),
                'icon' => 'pencil'
            ));
            ?>
        </div> 

            <?php
            
            $this->widget('bootstrap.widgets.TbDetailView', array(
                'id' => 'addUserForm',
                'type' => 'horizontal',
                'data' => $user,
                'attributes' => array(
                    'name',
                    'email',
                    'phone',
                ),
            ));
            
            ?>
   </div> 
    
    <div class="well">
        <h2><span>我的汽车</span></h2>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => '添加车辆',
            'type' => 'primary',
            'url' => 'createCar',
            'icon' => 'plus'
        ));
        ?>
        <?php
        $columns1 = array('licenseNumber', array('name'=>'type_id', 'type'=>'html', 'value'=>'$data->type->name'));
        //if ($hasType) array_push($columns, 'type');
        
        array_push($columns1, array(
        		'class'=>'bootstrap.widgets.TbButtonColumn', 
        		'deleteConfirmation'=>'确认删除此条记录？', 
        		 'buttons'=>array(
        				'book'=>array(
            				'label'=>'预约',
            				'url'=>'Yii::app()->createUrl("orders/create", array("car"=>$data->id))',
        					//'visible' => 'SiteRecommend::isItemInTypeAndId(1, $data->id)?true:false',
        					'visible'=>'empty($data->isOrdered)',
        					),
                            'update'=>array('label'=>'更新车辆信息'),
                            'delete'=>array('label'=>'删除该车辆'),
        				), 
        		'updateButtonUrl'=>'Yii::app()->createUrl("customer/updateCar", array("id"=>$data->id))',
        		'deleteButtonUrl'=>'Yii::app()->createUrl("customer/deleteCar", array("id"=>$data->id))', 
        		'template' => '{update}{delete}{book}'
        		));
        
        $this->widget('bootstrap.widgets.TbGridView', array(
        		'id' => 'car-grid',
        		'dataProvider' => $cars->search(),
        		//'filter' => $orders,
        		'columns' => $columns1,
        ));
        
        ?>
    </div>
    
    <div class="well">
        <h2><span>我的预约记录</span></h2>
        <?php
        
        $columns = array(
        		array('name'=>'车牌', 'type'=>'html', 'value'=>'$data->licenseNumber->licenseNumber'), 
        		'date',
        		'time', 
        		'comment', 
        		array('name'=>'status', 'type'=>'html', 'value'=>'Orders::getStatusName($data->status)'),
        		array('name'=>'接车员', 'type'=>'html', 'value'=>'$data->operator->id != 1 ? $data->operator->name : ""'),
        		);
        array_push($columns, array(
        		'class'=>'bootstrap.widgets.TbButtonColumn', 
        		'deleteConfirmation'=>'确认删除此条记录？', 
        		
        		'buttons'=>array(
        				'update'=>array(
        						'visible'=>'$data->status=="pending"',
        						'url'=>'Yii::app()->createUrl("orders/update", array("id"=>$data->id))',
        						'label'=>'修改预约',
        				),
        				'delete'=>array('label'=>'取消预约'),
        		),
        		
        		'deleteButtonUrl'=>'Yii::app()->createUrl("orders/delete", array("id"=>$data->id))',
        		'template' => '{update}{delete}'
        ));
        
        $this->widget('bootstrap.widgets.TbGridView', array(
        		'id' => 'order-grid',
        		'dataProvider' => $orders->search(),
        		//'filter' => $orders,
        		'columns' => $columns,
        ));
        ?>
    </div>
</div>


 <script type="text/javascript">
        $(function() {
            $('.block').css({height: 'auto'});
            //删除该客户信息
            $('#delete').click(function() {
                if (!confirm('确定删除此项吗？')) {
                    return false;
                }
            });
        })

    </script>