<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'UserForm',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'well'),
        ));
?>

<!--提示信息展示-->
<?php
if (Yii::app()->user->hasFlash('addsuccess')) {
    $this->redirect_message('添加成功', 'success', 3, Yii::app()->createUrl('settings/carTypes'));
} else if (Yii::app()->user->hasFlash('updatesuccess')) {
    $this->redirect_message('修改成功', 'success', 3, Yii::app()->createUrl('settings/carTypes'));
}
?>

<?php echo CHtml::link('返回', array('settings/carTypes')); ?>
<p class="help-block">带 <span class="required">*</span> 为必填项.</p>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span4')); ?>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'label' => $model->isNewRecord ? '添加' : '修改',
        'type' => 'primary'
    ));
    ?>
</div>
<?php $this->endWidget(); ?>

