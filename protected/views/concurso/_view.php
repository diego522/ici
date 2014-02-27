<?php
/* @var $this ConcursoController */
/* @var $data Concurso */
?>

<div class="view" style="">

    <div class="titulodetalle" style=" float:left; color:#06F; font-size:22px; width:170px; height:90px; font-weight:bold; text-align:left;">
        <?php echo CHtml::link($data->nombre, array('view', 'id' => $data->id_concurso)); ?>       

    </div>
    <div class="cajadetalle2" style=" padding-left:8px; float:left; border-left-width:1px; border-left-style:solid; border-left-color:#E4E4E4; float:left; color:#838383; font-size:12px; width:170px; height:90px; text-align:left;">
        <b><?php echo CHtml::encode($data->getAttributeLabel('fechaApertura')); ?>:</b>
        <br />
        <?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($data->fechaApertura)); ?><br />
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('fechaCierre')); ?>:</b>
        <br />
        <?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($data->fechaCierre)); ?>      

    </div>


    <div class="caja3detalle" style="padding-left:8px; float:left; border-left-width:1px; border-left-style:solid; border-left-color:#E4E4E4; color:#838383; font-size:12px; width:170px; height:90px; text-align:left;">

        <b><?php //echo CHtml::encode($data->getAttributeLabel('estado')); ?></b>
        <br />
        <?php //echo Estado::model()->findByPk($data->estado)->nombre; ?>
        <br />
        <br />

        <b><?php echo CHtml::encode('Acción') ?>:</b>
        <br />
        <?php
        if ($data->verificaDisponibilidadDePlazo())
            echo CHtml::link("Participar", array("equipo/create", "id" => $data->id_concurso));
        else
            echo 'No disponible';
        ?>
        <?php if (Yii::app()->user->checkAccess(Rol::$ADMINISTRADOR) || Yii::app()->user->checkAccess(Rol::$SUPER_USUARIO)) { ?>

        </div>

        <div class="caja4detalle" style=" padding-left:8px; float:left; border-left-width:1px; border-left-style:solid; border-left-color:#E4E4E4; color:#838383; font-size:12px; width:170px; height:90px; text-align:left;">
            <b><?php echo CHtml::encode($data->getAttributeLabel('Equipos')); ?>:</b>
            <br />
            <?php echo CHtml::link('Ver', array('equipo/index', 'idc' => $data->id_concurso)); ?>
            <br />

        <?php } ?>
    </div>

    <div class="verdetalle" style=" padding-left:8px; float:right; border-left-width:1px; border-left-style:solid; border-left-color:#E4E4E4; color:#06F; font-size:20px; width:170px; height:90px; font-weight:bold; text-align:center;">
        <?php echo CHtml::link("Ver", array('view', 'id' => $data->id_concurso)); ?>
    </div>  
</div>