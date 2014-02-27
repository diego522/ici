<?php
/* @var $this NoticiaController */
/* @var $data Noticia */
?>


<div style="width:600px; border:#039; border-bottom:1px dotted #999; display:table; padding-bottom:30px; margin-bottom:40px;">
    <i style="color:#B9B9B9;">
        <?php echo CHtml::encode($data->getAttributeLabel('fecha_actualizacion')); ?>: 
        <?php echo CHtml::encode($data->fecha_actualizacion); ?>
    </i>
    <h1>
        <?php echo CHtml::link(CHtml::encode($data->titulo), array('view', 'id' => $data->id_noticia)); ?>
    </h1>
    <?php echo substr(strip_tags($data->contenido), 0, 200) . '...'; ?>
    <div class="botonsimple">
        <?php echo CHtml::link(CHtml::encode("Leer"), array('view', 'id' => $data->id_noticia)); ?>
    </div>
</div>