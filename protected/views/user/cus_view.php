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
                <span><h2>我的客户</h2></span>
                <?php
                /*$criteria = new CDbCriteria;
                //$criteria->with = array('customer');
                //$criteria->together = true;
                $criteria->compare('employee_id', $user->id);
                $dataProvider = new CActiveDataProvider('Customer', array(
                    'criteria' => $criteria,
                ));
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'user-grid',
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        'name',
                        array('name' => 'amount_on_hand', 'value' => 'CustomerProduct::getOnHandMoney($data->id)', 'htmlOptions' => array('style' => 'width:14%')),
                        array('name' => 'total_amount', 'value' => 'CustomerProduct::getTotal($data->id)', 'htmlOptions' => array('style' => 'width:14%')),
                        array('name' => 'gender', 'value' => 'Customer::showGender($data->gender)'),
                        array('name' => 'idtype', 'value' => '$data->idtype==1?"身份证":"护照"', 'htmlOptions' => array('style' => 'width:10%')),
                        'identity_card',
                        'telephone',
                        'email',
                    ),
                ));*/
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