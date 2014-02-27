<?php
/* @var $this NivelController */
/* @var $model Nivel */
/* @var $dia Dia */
/* @var $bloque Bloque */
/* @var $horario Horario */
?>
<?php
$dias = Dia::model()->findAll();
$bloques = Bloque::model()->findAll();
$asignaturas = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus'));
?>
<h1>
    Horario  <?php echo $model->nombre; ?>
</h1>
<div align="center">
    <h4>Actualizado el <?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(Yii::app()->db->createCommand('select fecha_actualizacion from horario where id_nivel=' . $model->id_nivel . ' order by fecha_creacion DESC')->queryScalar())); ?></h4>
</div>
<table style="border: rgb(85, 85, 85) solid 1px;">
    <tr>
        <?php foreach ($dias as $dia) { ?>
            <td><?php echo $dia->nombre; ?></td>
        <?php } ?>
    </tr>

    <?php
    foreach ($bloques as $bloque) {
        ?>
        <tr >
            <td ><?php echo $bloque->hora_inicio . " - " . $bloque->hora_fin; ?></td>
            <?php
            foreach ($dias as $dia) {
                ?>
                <td >
                    <?php
                    $horarios = Horario::model()->findAll('id_nivel=:idn and id_dia=:idd and id_bloque=:idb and campus=:idc', array(':idn' => $model->id_nivel, ':idd' => $dia->id_dia, ':idb' => $bloque->id_bloque, ':idc' => Yii::app()->user->getState('campus')));
                    ?>
                    <table>

                        <?php
                        foreach ($horarios as $horario) {
                            ?>
                            <tr >
                                <td style="border: rgb(85, 85, 85) solid 1px;text-align: center;">
                                    <?php
                                    echo $asignaturas[$horario->id_ramo];
                                    echo "<br/>";
                                    echo $horario->descripcion;
                                    echo "<br/>";
                                    echo $horario->sala;
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

</table>
