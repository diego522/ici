<?php
/* @var $this PeriodoController */
/* @var $data Periodo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_periodo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_periodo), array('view', 'id'=>$data->id_periodo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_proceso')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_proceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_apertura')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_apertura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cierre')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cierre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	*/ ?>

</div>