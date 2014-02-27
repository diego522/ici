<?php
/* @var $this TipoEstadoController */
/* @var $data TipoEstado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_estado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tipo_estado), array('view', 'id'=>$data->id_tipo_estado)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>