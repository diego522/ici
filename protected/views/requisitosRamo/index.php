<?php
/* @var $this RequisitosRamoController */

$this->breadcrumbs = array(
    'Requisitos Ramo',
);

?>
<h1>Listado de Electivos con Prerequisitos en el Sistema</h1>

<?php
$electivos = Utilidades::obtenerTodosLosElectivosPorCampus(Yii::app()->user->getState('campus'));
?>

<table style="border: rgb(85, 85, 85) solid 1px;">
    <thead>
        <th>Electivo</th><th>Acción</th>
    </thead>

    <?php
    foreach ($electivos as $clave => $valor) {
        ?>
        <tr style="border: rgb(85, 85, 85) solid 1px;">
            <td style="border: rgb(85, 85, 85) solid 1px;"><?php echo $valor; ?></td>
            <td style="border: rgb(85, 85, 85) solid 1px;"><?php echo CHtml::link('Ver detalle', array('detalle', 'idR' => $clave)); ?></td>
        </tr>
        <?php
    }
    ?>

</table>