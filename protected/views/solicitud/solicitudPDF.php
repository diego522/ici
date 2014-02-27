<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */
?>
<style type="text/css">
    body
    {
        margin-left:100px;
        padding: 0;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 9pt;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
    }

    #page
    {
        margin-top: 5px;
        margin-bottom: 5px;
        background: white;
        border: 1px solid #C9E0ED;
    }
    div.titulo{
        padding-top:-10px;
        text-align: center;
    }
    #header
    {
        margin: 0;
        padding: 0;
        border-top: 3px solid #C9E0ED;
    }
    p{
        text-align: justify;
    }
    #content
    {
        padding: 20px;
    }

    .titulo
    {
        text-align: center;
    }
    .final
    {
        text-align: center;
    }

    #footer
    {
        padding: 10px;
        margin: 10px 20px;
        font-size: 0.8em;
        text-align: center;
        border-top: 1px solid #C9E0ED;
    }



    .logo{

        /*padding-top:-60px;  */      
        text-align:center;
    }


    .tablaforms{
        border:#000 solid 6px;


    }

</style>
<div class="logo">
    <?php echo CHtml::image(Yii::app()->getBaseUrl(true) . "/images/escudo_ubb.png", ''); ?>
</div>
<div class="titulo">
    <h3>Solicitud a Dirección de Escuela/Jefatura de Carrera</h3>
    <h4 style="margin-top:-10px;"> Facultad de Ciencias Empresariales</h4>
    <h4 style="margin-top:-10px;"> Escuela de Ingeniería Civil Informática</h4>
</div>
<br />
<h4>Datos Generales</h4>
<table>
    <tr>
        <td><b>Código Solicitud:</b></td>
        <td><?php echo $model->id_solicitud; ?></td>
    </tr>
    <tr>
        <td><b>Tipo de Solicitud:</b></td>
        <td><?php echo $model->tipoSolicitud->nombre; ?></td>
    </tr>
    <tr>
        <td><b>Estudiante:</b></td>
        <td><?php echo $model->idAlumno->nombre; ?></td>
    </tr>
    <tr>
        <td><b>Rut:</b></td>
        <td><?php echo $model->idAlumno->username; ?></td>
    </tr>

    <tr>
        <td><b>Estado:</b></td>
        <td><?php echo $model->estado0->nombre; ?></td>
    </tr>
    <tr>
        <td><b>Fecha de Creación:</b></td>
        <td><?php echo $model->fecha_creacion; ?></td>
    </tr>

</table>
<?php
if (Yii::app()->user->getState("carrera") != NULL && Yii::app()->user->getState("plan") != NULL) {
    $todosLosRamos = Utilidades::obtenerTodosLosRamosPlanYCarrera(Yii::app()->user->getState("carrera"), Yii::app()->user->getState("plan"));
} else {
    //traer mallas segun campus
    $todosLosRamos = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState("campus"));
}
?>

<br/>
    <h4>Asignaturas que solicita inscribir</h4>
    <p style="margin-top:-10px;"> (en orden de prioridad)</p>



<table>
    <?php
    $contador=1;
    foreach ($model->ramoSolicituds as $ramo) {
        foreach ($todosLosRamos as $clave => $valor) {
            if ($ramo->id_ramo == $clave) {
                echo '<tr><td>'.$contador.'.-</td><td>' . $valor . '</td></tr>';
                $contador++;
            }
        }
    }
    ?>
</table>
<br/>
<h4>Motivo</h4>

    <?php echo $model->motivo; ?>

<br />
&nbsp;<br />
<br />
<br />
<br />
<br /><br />
<br />
<div> 
    <h6>Emitido el <?php echo date('d/m/Y H:m'); ?> hrs.</h6>
</div>