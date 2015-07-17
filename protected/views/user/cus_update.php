<div class="content">
    <div class="header">

        <h1 class="page-title">车主中心</h1>
    </div>

    <?php
    /* @var $this CustomerController */

    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>array('车主中心'=>array('customers'), '修改车主信息'),
    )); ?>
    <div class="container-fluid">
  <?php echo $this->renderPartial('cus_form', array('model'=>$model)); ?>
</div>
      
</div>