<?php
/* @var $this RamoSolicitudController */
/* @var $model RamoSolicitud */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ramo-solicitud-create-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_solicitud'); ?>
		<?php echo $form->textField($model,'id_solicitud'); ?>
		<?php echo $form->error($model,'id_solicitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_ramo'); ?>
		<?php echo $form->textField($model,'id_ramo'); ?>
		<?php echo $form->error($model,'id_ramo'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->