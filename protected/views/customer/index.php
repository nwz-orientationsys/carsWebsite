
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
        <div class="container-fluid">
            <?php echo CHtml::link('返回', array('customer/index')); ?>
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
            <div class="well">
                <span><h2>我的汽车</h2></span>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '添加车辆',
                    'type' => 'primary',
                    'url' => '/customer/createCar',
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
                				)),
                		'updateButtonUrl'=>'Yii::app()->createUrl("customer/updateCar", array("id"=>$data->id))',
                		'deleteButtonUrl'=>'Yii::app()->createUrl("customer/deleteCar", array("id"=>$data->id))', 'template' => '{update}{delete}{book}'
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
                <span><h2>我的预约记录</h2></span>
                <?php
                
                $columns = array('date', 'time', 'comment');
                array_push($columns, array(
                		'class'=>'bootstrap.widgets.TbButtonColumn', 
                		'deleteConfirmation'=>'确认删除此条记录？', 
                		'updateButtonUrl'=>'Yii::app()->createUrl("orders/update", array("id"=>$data->id))',
                		'deleteButtonUrl'=>'Yii::app()->createUrl("orders/delete", array("id"=>$data->id))','template' => '{update}{delete}'));
                
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