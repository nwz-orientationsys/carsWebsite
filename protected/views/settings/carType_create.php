<div class="content">
    
    <div class="header">

        <h1 class="page-title">汽车类型</h1>
    </div>
<?php 
	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'links'=>array('汽车类型'=>array('carTypes'), '添加汽车类型'),
    )); ?>
<div class="container-fluid">
	<?php echo $this->renderPartial('_form_carType', array('model'=>$model)); ?>
</div>
</div>
