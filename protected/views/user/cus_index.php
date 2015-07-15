<div class="content">
    <div class="header">
        <h1 class="page-title">车主中心</h1>
    </div>
    <?php
    
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links' => array('车主中心' => array('index'), '车主列表'),
    ));
    ?>
    <div class="container-fluid">
        <div class="row-fluid">
        
            <div class="btn-toolbar">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '添加车主',
                    'type' => 'primary',
                    'url' => '/user/createcustomer',
                    'icon' => 'plus'
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
                    'email', 'phone');
                if ($hasType) array_push($columns, 'type');
                
                array_push($columns, array(
                    'class'=>'bootstrap.widgets.TbButtonColumn', 
                    'deleteConfirmation'=>'确认删除此条记录？', 
                    'template' => '{view}{update}{delete}'
                ));
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'customer-grid',
                    'dataProvider' => $customer->search(),
                    'filter' => $customer,
                    'columns' => $columns,
                ));
                ?>
			</div>
		</div>
	</div>
</div>