<?php
/* @var $this NivelController */
/* @var $model Nivel */
/* @var $dia Dia */
/* @var $bloque Bloque */
/* @var $horario Horario */

$this->breadcrumbs = array(
    'Administrador de horarios' => array('admin'),
    $model->nombre,
);

$this->menu = array(
    //array('label' => 'List Nivel', 'url' => array('index')),
    //array('label' => 'Create Nivel', 'url' => array('create')),
    //array('label' => 'Update Nivel', 'url' => array('update', 'id' => $model->id_nivel)),
    //array('label' => 'Eliminar Nivel', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_nivel), 'confirm' => 'Srgu?')),
    array('label' => 'Volver Administrador de horarios Nivel', 'url' => array('admin')),
);
?>
<?php
$dias = Dia::model()->findAll();
$bloques = Bloque::model()->findAll();
$asignaturas = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus'));
?>
<h1>
   Editar horario <?php echo $model->nombre; ?>
</h1>
<div class="iconosdescarga">
    <?php //echo CHtml::link('<img align="middle" title="Descarga esta solicitud en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>' . ' Descargar Horario', array('verPDF', 'id' => $model->id_nivel,)); ?>
</div>
<table style="border: rgb(85, 85, 85) solid 1px; font-size: 13px;">
    <thead>
    <th></th>
    <?php foreach ($dias as $dia) { ?>
        <th><?php echo $dia->nombre; ?></th>
    <?php } ?>
</thead>
<tbody>
    <?php
    foreach ($bloques as $bloque) {
        ?>
        <tr style="border: rgb(85, 85, 85) solid 1px;">
            <td style="border: rgb(85, 85, 85) solid 1px;"><?php echo $bloque->hora_inicio . " - " . $bloque->hora_fin; ?></td>
            <?php
            foreach ($dias as $dia) {
                ?>
                <td style="border: rgb(85, 85, 85) solid 1px;">
                    <?php
                    $horarios = Horario::model()->findAll('id_nivel=:idn and id_dia=:idd and id_bloque=:idb and campus=:idc', array(':idn' => $model->id_nivel, ':idd' => $dia->id_dia, ':idb' => $bloque->id_bloque, ':idc' => Yii::app()->user->getState('campus')));
                    ?>
                    <table>
                        <tr>
                            <td style="text-align: center;"><?php echo CHtml::link('Agregar', array('horario/create', 'idn' => $model->id_nivel, 'idd' => $dia->id_dia, 'idb' => $bloque->id_bloque), array('id' => 'inline')); ?></td>
                        </tr>
                        <?php
                        foreach ($horarios as $horario) {
                            ?>
                        
                            <tr style="border: rgb(85, 85, 85) solid 1px;">
                                <td style="border: rgb(85, 85, 85) solid 1px; text-align: center;">
                                    
                                    <?php
                                    echo $asignaturas[$horario->id_ramo];
                                    echo "<br/>";
                                    echo $horario->descripcion;
                                    echo "<br/>";
                                    echo $horario->sala;
                                    echo "<br/>";
                                    echo CHtml::link('eliminar', array('horario/eliminar', 'id' => $horario->id_horario,), array('confirm' => 'Seguro desea eliminar este item?')) . " " . CHtml::link('editar', array('horario/update', 'id' => $horario->id_horario,), array('id' => 'inline'));
                                    ?>
                                </td>
                            </tr>
                           
                            <?php
                        }
                        ?>
                    </table>
                    <?php ?>
                </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => false,
    ),
        )
);
?>