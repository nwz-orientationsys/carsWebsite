<?php 
$this->breadcrumbs = array('我的信息'=>array('/customer'), '修改汽车类型');
?>

<?php echo $this->renderPartial('_form_car', array('model'=>$model)); ?>