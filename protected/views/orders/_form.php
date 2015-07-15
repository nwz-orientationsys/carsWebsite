<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">


<?php
/*  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 
*/?>

<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'orders-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'well'),
        ));
?>

	<p class="note">带<span class="required">*</span>为必填项</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->dropDownListRow($model,'car_id',Cars::getCustomerCars(Yii::app()->user->id),array('class' => 'span4')); ?>
	
		<?php //echo $form->textField($model,'car_id',array('class' => 'span4')); ?>
		
		<?php echo $form->textFieldRow($model,'date',array('class' => 'span4 datepicker')); ?>
		
		<?php echo $form->dropDownListRow($model,'time', array('AM'=>'上午', 'PM'=>'下午'),array('class' => 'span4')); ?>

		<?php echo $form->textFieldRow($model,'comment',array('size'=>60,'maxlength'=>255,'class' => 'span4')); ?>

		<br></br>
		
		<?php echo CHtml::submitButton($model->isNewRecord ? '预约' : '修改'); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->