<?php 
$this->breadcrumbs = array('我的信息'=>array('/customer'), '添加汽车');
?>

<?php echo $this->renderPartial('_form_car', array('model'=>$model)); ?>
