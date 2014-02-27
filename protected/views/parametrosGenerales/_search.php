<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_parametros_generales'); ?>
		<?php echo $form->textField($model,'id_parametros_generales'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'campus'); ?>
		<?php echo $form->textField($model,'campus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_jefe_carrera'); ?>
		<?php echo $form->textField($model,'correo_jefe_carrera',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_jefe_carrera'); ?>
		<?php echo $form->textField($model,'nombre_jefe_carrera',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_director_departamento'); ?>
		<?php echo $form->textField($model,'correo_director_departamento',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_director_departamento'); ?>
		<?php echo $form->textField($model,'nombre_director_departamento',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_secretaria'); ?>
		<?php echo $form->textField($model,'correo_secretaria',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->