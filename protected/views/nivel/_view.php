<?php
/* @var $this NivelController */
/* @var $data Nivel */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id' => $data->id_nivel)); ?>
    <br />
    <b>Actualizado el:</b>
    <?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(Yii::app()->db->createCommand('select fecha_actualizacion from horario where id_nivel=' . $data->id_nivel . ' order by fecha_creacion DESC')->queryScalar())); ?>

    <br />



</div>