<div class="content">
    <div class="header">
        <h1 class="page-title">员工中心</h1>
    </div>

    <?php
    /* @var $this CustomerController */

    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links' => array('员工中心' => array('index'), '查看员工 ' . $user->name),
    ));
    ?>
    <div class="container-fluid">
        <div class="btn-toolbar">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => '修改',
                'type' => 'primary',
                'url' => array('user/update', 'id' => $userid),
                'icon' => 'pencil'
            ));
            ?>
            <?php
            if (Yii::app()->user->checkAccess('admin')) {
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '删除',
                    'type' => '',
                    'url' => array('user/delete', 'id' => $userid),
                    'icon' => 'trash',
                    'htmlOptions' => array('id' => 'delete')
                ));
            }
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
                    'url' => 'createCar',
                    'icon' => 'plus'
                ));
                ?>
                <?php
                $columns1 = array('licenseNumber', array('name'=>'type_id', 'type'=>'html', 'value'=>'$data->type_name->name'));
                //if ($hasType) array_push($columns, 'type');
                
                array_push($columns1, array(
                		'class'=>'bootstrap.widgets.TbButtonColumn', 
                		'deleteConfirmation'=>'确认删除此条记录？', 
                		'buttons'=>array(
                				'book'=>array(
	                				'label'=>'预约',
	                				'url'=>'Yii::app()->createUrl("orders/create", array("id"=>$data->id))',
                				)),
                		'updateButtonUrl'=>'Yii::app()->createUrl("customer/updateCar", array("id"=>$data->id))',
                		'deleteButtonUrl'=>'Yii::app()->createUrl("customer/deleteCar", array("id"=>$data->id))', 'template' => '{view}{update}{delete}{book}'
                		));
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                		'id' => 'order-grid',
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
                //if ($hasType) array_push($columns, 'type');
                
                //array_push($columns, array('class'=>'bootstrap.widgets.TbButtonColumn', 'deleteConfirmation'=>'确认删除此条记录？', 'template' => '{view}{update}{delete}'));
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                		'id' => 'order-grid',
                		'dataProvider' => $orders->search(),
                		//'filter' => $orders,
                		'columns' => $columns,
                ));
                ?>
            </div>
        </div>
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