<?php
/* @var $this RamoLocalController */
/* @var $model RamoLocal */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_ramo'); ?>
		<?php echo $form->textField($model,'id_ramo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agn_nombre'); ?>
		<?php echo $form->textField($model,'agn_nombre',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->