<?php
/* @var $this BloqueController */
/* @var $data Bloque */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bloque')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_bloque), array('view', 'id'=>$data->id_bloque)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->hora_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_fin')); ?>:</b>
	<?php echo CHtml::encode($data->hora_fin); ?>
	<br />


</div>