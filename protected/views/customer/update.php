<div class="content">
    <div class="header">

        <h1 class="page-title">我的信息</h1>
    </div>

    <?php
    /* @var $this CustomerController */

        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links'=>array('我的信息'=>array('index'), '修改我的个人信息'),
        )); ?>
    <div class="container-fluid">
  <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
      
</div>