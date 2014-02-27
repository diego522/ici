<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs = array(
    'Equipos',
    $model->nombre,
);

?>

<h1>Equipo <?php echo $model->nombre; ?> </h1>


<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        /*'id_equipo',*/
        'nombre',
        array('name'=>'estado',
            'value'=>$model->estado?Estados::model()->findByPk($model->estado)->nombre:'participante',
            ),
        
        array('name' => 'participantes',
            'type' => 'raw',
            'value' => $lista,),
        array('name' => 'Acciones del equipo', 'type' => 'raw', 'value' => CHtml::link('Agregar participante', array('equipoRelUsuarioRelConcurso/agrega', 'idc' => $idc, 'ide' => $model->id_equipo), array('id' => 'inline'))),
        array('name' => '', 'type' => 'raw', 'value' => CHtml::link('Renunciar al equipo', array('equipoRelUsuarioRelConcurso/renuncia', 'idc' => $idc, 'ide' => $model->id_equipo))),
        array('name' => 'Propuestas (en PDF)', 'type' => 'raw', 'value' => CHtml::link('Agregar propuesta', array('equipo/uploadFile', 'idc' => $idc, 'ide' => $model->id_equipo, 'prop' => 'c'), array('id' => 'propuesta'))),
        array('name' => 'Propuesta en B/N', 'type' => 'raw', 'value' => $model->adjunto_bn ? CHtml::link('Descargar', array('equipo/download', 'id' => $model->adjunto_bn,)) : 'no hay accion'),
        array('name' => 'Propuesta en Color', 'type' => 'raw', 'value' => $model->adjunto_color ? CHtml::link('Descargar', array('equipo/download', 'id' => $model->adjunto_color,)) : 'no hay accion'),
    ),
));
?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => true,
    ),
        )
);
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#propuesta',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => true,
    ),
        )
);
?>
