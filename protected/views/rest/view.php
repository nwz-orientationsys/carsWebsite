<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<?php

$form = $this->beginWidget('CActiveForm', array(
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));
?>
<table cellpadding="5" cellspacing="3"
	style="text-align: left; width: 100%; border: 0;">
	<tbody>
		<tr>
			<td style="width: 13%; text-align: right;">
                    <?php echo $form->labelEx($user_model, 'name'); ?>
                </td>

			<td style="width: 87%;">
                     <?php echo $form->textField($user_model,'name'); ?>
                    <!--表单验证失败显示错误信息-->
                    <?php echo $form ->error($user_model,'name'); ?>
                </td>
		</tr>

		<tr>
			<td align="right">
                   <?php echo $form->labelEx($user_model, 'password'); ?>
                </td>

			<td>
                    <?php echo $form->passwordField($user_model,'password'); ?>
                    <?php echo $form ->error($user_model,'password'); ?>
                </td>
		</tr>

		<tr>
			<td align="right"><?php echo $form->label($user_model, 'email'); ?></td>
			<td>
                    <?php echo $form->textField($user_model,'email'); ?>
                    <?php echo $form->error($user_model,'email'); ?>
                </td>
		</tr>
		
		<tr>
			<td align="right"><?php echo $form->labelEx($user_model, 'phone'); ?></td>
			<td>
                    <?php echo $form->textField($user_model,'phone'); ?>
                    <?php echo $form->error($user_model,'phone'); ?>
                </td>
		</tr>

		<tr>
			<td>&nbsp;</td>

			<td align="left"><input name="Submit" value="提交" type="submit" /></td>
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</tbody>
</table>

<?php $this->endWidget(); ?>