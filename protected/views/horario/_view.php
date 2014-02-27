<?php
/* @var $this HorarioController */
/* @var $data Horario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_horario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_horario), array('view', 'id'=>$data->id_horario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_nivel')); ?>:</b>
	<?php echo CHtml::encode($data->id_nivel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ramo')); ?>:</b>
	<?php echo CHtml::encode($data->id_ramo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_dia')); ?>:</b>
	<?php echo CHtml::encode($data->id_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bloque')); ?>:</b>
	<?php echo CHtml::encode($data->id_bloque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_actualizacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sala')); ?>:</b>
	<?php echo CHtml::encode($data->sala); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	*/ ?>

</div>