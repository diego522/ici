<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */



?>

<h1>Detalle de la Inscripción </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_inscripcion',
        'actividad',
        'fecha_apertura',
        //'fecha_creacion',
        'fecha_cierre',
        array('name' => 'estado', 'value' => $model->estado0->nombre),
        //'creador',
        'cupos',
        'descripcion',
        //'campus',
        'requisitos',
        'horario',
        array('name' => 'adjunto',
            'type' => 'raw',
            'value' => $model->adjunto ? CHtml::link('Descargar', array('download', 'id' => $model->id_inscripcion)) : 'No Hay'
        ),
    ),
));
?>
