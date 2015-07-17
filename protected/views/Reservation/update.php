<?php 
$this->breadcrumbs = array('预约中心'=>array('reservation/index'), '修改预约');
?>

<?php $this->renderPartial('_form', array('model'=>$model,'type'=>$type));?>