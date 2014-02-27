<?php
/* @var $this AdjuntoController */
/* @var $data Adjunto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_adjunto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_adjunto), array('view', 'id'=>$data->id_adjunto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruta')); ?>:</b>
	<?php echo CHtml::encode($data->ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creador')); ?>:</b>
	<?php echo CHtml::encode($data->creador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>