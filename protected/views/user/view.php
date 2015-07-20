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
                'url' => array('user/update', 'id' => $_GET['id']),
                'icon' => 'pencil'
            ));
            ?>
            <?php
            if (Yii::app()->user->checkAccess('admin')) {
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '删除',
                    'type' => '',
                    'url' => array('user/delete', 'id' => $_GET['id']),
                    'icon' => 'trash',
                    'htmlOptions' => array('id' => 'delete')
                ));
            }
            ?>
        </div>
        <div class="container-fluid">
            <?php echo CHtml::link('返回', array('user/index')); ?>
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

            <div class="well" id="test">
                <h2><span>他的客户</span></h2>
                <input id="flag" type="hidden" value="<?php echo $flag?>" />
                <?php
                $columns = array(
                		array(
                				'name'=>'owner_name',
                				'type'=>'html',
                				'value'=>'$data->applicant->name',
                		),
                		array(
                				'name'=>'owner_phone',
                				'type'=>'html',
                				'value'=>'$data->applicant->phone',
                		),
                		array(
                				'name'=>'car_licenseNumber',
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
                		'columns' => $columns,
                ));
                ?>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
        $(function() {
			$('#flag').val()=='1' ? $('#test').hide() : "";
            $('.block').css({height: 'auto'});
            //删除该客户信息
            $('#delete').click(function() {
                if (!confirm('确定删除此项吗？')) {
                    return false;
                }
            });
        });
    </script>