<div class="content">
    
    <div class="header">

        <h1 class="page-title">车辆管理</h1>
    </div>
<?php 
	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'links'=>array('车辆管理'=>array('carTypes'), '添加汽车'),
    )); ?>
<div class="container-fluid">
	<?php echo $this->renderPartial('_form_car', array('model'=>$model)); ?>
</div>
</div>
