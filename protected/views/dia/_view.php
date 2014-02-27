<?php
/* @var $this DiaController */
/* @var $data Dia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_dia')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_dia), array('view', 'id'=>$data->id_dia)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>