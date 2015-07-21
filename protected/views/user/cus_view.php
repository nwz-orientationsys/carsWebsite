<div class="content">
    <div class="header">
        <h1 class="page-title">车主中心</h1>
    </div>

    <?php
    /* @var $this CustomerController */

    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links' => array('车主中心' => array('customers'), '查看车主 ' . $customer->name),
    ));
    ?>
    <div class="container-fluid">
        <div class="btn-toolbar">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => '修改',
                'type' => 'primary',
                'url' => array('user/cusupdate', 'id' => $_GET['id']),
                'icon' => 'pencil'
            ));
            ?>
            <?php
            if (Yii::app()->user->checkAccess('admin')) {
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '删除',
                    'type' => '',
                    'url' => array('user/cusdelete', 'id' => $_GET['id']),
                    'icon' => 'trash',
                    'htmlOptions' => array('id' => 'delete')
                ));
            }
            ?>
        </div>
        <div class="container-fluid">
            <?php echo CHtml::link('返回', array('user/customers')); ?>
            <?php
            $this->widget('bootstrap.widgets.TbDetailView', array(
                'id' => 'addCustomerForm',
                'type' => 'horizontal',
                'data' => $customer,
                'attributes' => array(
                    'name',
                    'email',
                    'phone',
                ),
            ));
            ?>

            <div class="well">
                <h2><span>车主汽车</span></h2>
                <?php
                $columns1 = array('licenseNumber', array('name'=>'type_id', 'type'=>'html', 'value'=>'$data->type->name'));
                //if ($hasType) array_push($columns, 'type');
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                		'id' => 'car-grid',
                		'dataProvider' => $cars->search(),
                		//'filter' => $orders,
                		'columns' => $columns1,
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