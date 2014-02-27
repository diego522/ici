<?php
/* @var $this RequisitosController */
/* @var $model Requisitos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requisitos-create-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ramo'); ?>
		<?php echo $form->textField($model,'ramo'); ?>
		<?php echo $form->error($model,'ramo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requisito'); ?>
		<?php echo $form->textField($model,'requisito'); ?>
		<?php echo $form->error($model,'requisito'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->