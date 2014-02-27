<?php
/* @var $this ConcursoController */
/* @var $model Concurso */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_concurso'); ?>
		<?php echo $form->textField($model,'id_concurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaCreacion'); ?>
		<?php echo $form->textField($model,'fechaCreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaApertura'); ?>
		<?php echo $form->textField($model,'fechaApertura'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaCierre'); ?>
		<?php echo $form->textField($model,'fechaCierre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adjunto'); ?>
		<?php echo $form->textField($model,'adjunto',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->