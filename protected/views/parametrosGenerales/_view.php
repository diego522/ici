<?php
/* @var $this ParametrosGeneralesController */
/* @var $data ParametrosGenerales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_parametros_generales')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_parametros_generales), array('view', 'id'=>$data->id_parametros_generales)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_jefe_carrera')); ?>:</b>
	<?php echo CHtml::encode($data->correo_jefe_carrera); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_jefe_carrera')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_jefe_carrera); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_director_departamento')); ?>:</b>
	<?php echo CHtml::encode($data->correo_director_departamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_director_departamento')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_director_departamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_secretaria')); ?>:</b>
	<?php echo CHtml::encode($data->correo_secretaria); ?>
	<br />


</div>