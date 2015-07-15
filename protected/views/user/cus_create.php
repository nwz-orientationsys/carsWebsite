<div class="content">
    
    <div class="header">

        <h1 class="page-title">车主中心</h1>
    </div>
<?php 
	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'links'=>array('车主中心'=>array('index'), '添加车主'),
    )); ?>
<div class="container-fluid">
	<?php echo $this->renderPartial('cus_form', array('model'=>$model)); ?>
</div>
</div>
