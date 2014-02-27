<?php
/* @var $this RamoLocalController */
/* @var $data RamoLocal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ramo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ramo), array('view', 'id'=>$data->id_ramo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agn_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->agn_nombre); ?>
	<br />


</div>