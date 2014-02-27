<?php
/* @var $this EquipoController */
/* @var $data Equipo */
?>

<div class="view"><div class="titulodetalle">
        
        <?php echo CHtml::link(CHtml::encode($data->nombre), array('viewEquipo', 'id' => $data->id_equipo)); ?></div>
    <div class="cajadetalle"><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>: <?php echo CHtml::encode($data->estado ? Estados::model()->findByPk($data->estado)->nombre : 'participante'); ?><br />
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_presentacion')); ?>:</b> <?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($data->fecha_presentacion)); ?></div>

    <div class="cajadetalle">
        <b><?php echo CHtml::encode($data->getAttributeLabel('adjunto_bn')); ?>:</b>
        <?php echo $data->adjunto_bn ? CHtml::link('Descargar', array('equipo/download', 'id' => $data->adjunto_bn,)) : 'no hay archivo'; ?>
        <br />
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('adjunto_color')); ?>:</b> <?php echo $data->adjunto_color ? CHtml::link('Descargar', array('equipo/download', 'id' => $data->adjunto_color,)) : 'no hay archivo'; ?></div>
    <br />

</div>