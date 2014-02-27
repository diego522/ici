<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div align="center">
    <h2>Listado de Inscritos</h2>
    <h4>Generado el <?php echo date('d/m/Y H:i'); ?></h4>
</div>
<table border="0" align="center" >
    <tr>
        <td><b>Ramo:</b></td>
        <td><?php echo $this->gridViewRamo($model->ramo); ?></td>
    </tr>
    <tr>
        <td><b>Fecha de Apertura:</b></td>
        <td><?php echo $model->fecha_apertura; ?></td>
    </tr>
    <tr>
        <td><b>Fecha de Cierre:</b></td>
        <td><?php echo $model->fecha_cierre; ?></td>
    </tr>
    <tr>
        <td><b>Cupos:</b></td>
        <td><?php echo $model->cupos; ?></td>
    </tr>
    <tr>
        <td><b>Inscritos:</b></td>
        <td><?php echo count($model->usuarios); ?></td>
    </tr>
</table>

<p></p>
<table border="1" align="center">
    <tr>
        <td><b>NOMBRE</b></td> <td><b>RUT</b></td> <td><b>EMAIL</b></td> <td><b>Fecha de Inscripción</b></td>
    </tr>
    <?php
    foreach ($model->usuarios as $us) {
        ?>
        <tr>
            <td><?php echo $us->nombre; ?></td> <td><?php echo $us->username; ?></td> <td><?php echo $us->email; ?></td> <td><?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => $us->id_usuario, 'idi' => $model->id_preinscripcion))->fecha_realizacion)); ?></td>
        </tr>
        <?php
    }
    ?>
</table>