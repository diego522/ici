<?php
/* @var $this SolicitudController */
/* @var $data Solicitud */
?>

<div class="view">

    <h3>
        <?php echo CHtml::link('Ver detalle', array('view', 'id' => $data->id_solicitud)); ?>
    </h3>

    <b><?php echo CHtml::encode($data->getAttributeLabel('tipo_solicitud')); ?>:</b>
    <?php echo CHtml::encode($data->tipoSolicitud->nombre); ?>
    <br />



    <b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
    <?php echo CHtml::encode($data->estado0->nombre); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
    <?php echo CHtml::encode($data->fecha_creacion); ?>
    <br />



    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('motivo_rechazo')); ?>:</b>
      <?php echo CHtml::encode($data->motivo_rechazo); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('id_periodo')); ?>:</b>
      <?php echo CHtml::encode($data->id_periodo); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_resolucion')); ?>:</b>
      <?php echo CHtml::encode($data->fecha_resolucion); ?>
      <br />

     */ ?>

</div>