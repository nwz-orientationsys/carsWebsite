<div class="content">
    <div class="header">
        <h1 class="page-title">系统设置</h1>
    </div>
    <?php
    
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links' => array('汽车类型设置' => array('carTypes'), '汽车类型列表'),
    ));
    ?>
    <div class="container-fluid">
        <div class="row-fluid">
        
            <div class="btn-toolbar">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => '添加汽车类型',
                    'type' => 'primary',
                    'url' => '/settings/createCarType',
                    'icon' => 'plus'
                ));
                ?>

            </div>
            
            
            <div class="well">
                <?php 
                
                $columns = array('name');
                array_push($columns, array('class'=>'bootstrap.widgets.TbButtonColumn', 'deleteConfirmation'=>'确认删除此条记录？', 
                                            'deleteButtonUrl' => 'Yii::app()->createUrl("settings/deleteCarType", array("id"=>$data->id))',
                                            'updateButtonUrl' => 'Yii::app()->createUrl("settings/updateCarType", array("id"=>$data->id))',
                                            'template' => '{update}{delete}'));
                
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'user-grid',
                    'dataProvider' => $carTypes->search(),
                    'filter' => $carTypes,
                    'columns' => $columns,
                ));
                ?>
	