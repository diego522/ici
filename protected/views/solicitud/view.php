<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */

$this->breadcrumbs = array(
    'Mis Solicitudes' => array('index'),
    'Detalle de la Solicitud',
);

$this->menu = array(
    array('label' => 'Mis Solicitudes', 'url' => array('index')),
    array('label' => 'Modificar Solicitud', 'url' => array('update', 'id' => $model->id_solicitud)),
    array('label' => 'Eliminar Solicitud', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_solicitud), 'confirm' => 'seguro que desea eliminar este item?')),
);
?>

<h1>Detalle de la Solicitud</h1>
<div class="iconosdescarga">
    <?php echo CHtml::link('<img align="middle" title="Descarga esta solicitud en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>' . ' Descargar Solicitud', array('verPDF', 'id' => $model->id_solicitud,)); ?>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_solicitud',
        array('name' => 'tipo_solicitud',
            'value' => $model->tipoSolicitud->nombre),
        array('name' => 'id_alumno',
            'value' => $model->idAlumno->nombre . ', ' . $model->idAlumno->username),
        array('name' => 'fecha_creacion'),
        array('name' => 'estado',
            'value' => $model->estado0->nombre),
        array('name' => 'motivo_rechazo',
            'value' => $model->motivo_rechazo,
            'type' => 'raw',
            'visible' => $model->estado != Estado::$SOLICITUD_PENDIENTE_DE_REVISION? true : false),
        array('name' => 'fecha_resolucion', 'visible' => $model->estado != Estado::$SOLICITUD_PENDIENTE_DE_REVISION ? true : false),
        array('name' => 'adjunto',
            'type' => 'raw',
            'value' => $model->adjunto ? CHtml::link('Descargar', array('download', 'id' => $model->id_solicitud)) : 'No Hay'
        ),
        array('name' => 'motivo',
            'type' => 'raw'),
    //'adjunto',
    //'id_periodo',
    ),
));

if (Yii::app()->user->getState("carrera") != NULL && Yii::app()->user->getState("plan") != NULL) {
    $todosLosRamos = Utilidades::obtenerTodosLosRamosPlanYCarrera(Yii::app()->user->getState("carrera"), Yii::app()->user->getState("plan"));
} else {
    //traer mallas segun campus
    $todosLosRamos = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState("campus"));
}
?>
<h3>Asignaturas que solicita inscribir</h3>
(en orden de prioridad)
<br/>
<table>
    <?php
    $contador = 1;
    $ramosElegidos = array();
    foreach ($todosLosRamos as $clave => $valor) {
        foreach ($model->ramoSolicituds as $ramo) {
             //echo $ramo->id_ramo." ";
            if ($ramo->id_ramo == $clave) {
               
                $ramosElegidos[] = $contador . '.- ' . $valor;
                $contador++;
            }
        }
    }
    //sort($ramosElegidos);
    foreach ($ramosElegidos as $r) {
        echo "<tr><td>" . $r . "</td></tr>";
    }
    ?>
</table>
