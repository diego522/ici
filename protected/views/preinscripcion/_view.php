<?php
/* @var $this PreinscripcionController */
/* @var $data Preinscripcion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_preinscripcion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_preinscripcion), array('view', 'id'=>$data->id_preinscripcion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ramo')); ?>:</b>
	<?php echo CHtml::encode($data->ramo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cierre')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cierre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creador')); ?>:</b>
	<?php echo CHtml::encode($data->creador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cupos')); ?>:</b>
	<?php echo CHtml::encode($data->cupos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_prerrequisitos')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_prerrequisitos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('local')); ?>:</b>
	<?php echo CHtml::encode($data->local); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adjunto')); ?>:</b>
	<?php echo CHtml::encode($data->adjunto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horario')); ?>:</b>
	<?php echo CHtml::encode($data->horario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('docente')); ?>:</b>
	<?php echo CHtml::encode($data->docente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_apertura')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_apertura); ?>
	<br />

	*/ ?>

</div>