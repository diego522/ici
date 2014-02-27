<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_preinscripcion'); ?>
		<?php echo $form->textField($model,'id_preinscripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ramo'); ?>
		<?php echo $form->textField($model,'ramo',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_cierre'); ?>
		<?php echo $form->textField($model,'fecha_cierre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creador'); ?>
		<?php echo $form->textField($model,'creador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cupos'); ?>
		<?php echo $form->textField($model,'cupos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'campus'); ?>
		<?php echo $form->textField($model,'campus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_prerrequisitos'); ?>
		<?php echo $form->textArea($model,'descripcion_prerrequisitos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'local'); ?>
		<?php echo $form->textField($model,'local'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adjunto'); ?>
		<?php echo $form->textField($model,'adjunto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horario'); ?>
		<?php echo $form->textArea($model,'horario',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'docente'); ?>
		<?php echo $form->textField($model,'docente',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_apertura'); ?>
		<?php echo $form->textField($model,'fecha_apertura'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->