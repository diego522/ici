<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */

$this->breadcrumbs = array(
    'Inscripciones disponibles',
);
?>

<h1>Inscripciones Disponibles</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'inscripcion-grid',
    'dataProvider' => $model->searchDisponibles(),
    'filter' => $model,
    'columns' => array(
        //'id_inscripcion',
        'actividad',
        array('header' => 'Cupos', 'value' => array($this,'gridCupos')),
        array('header' => 'Inscritos', 'value' => array($this,'gridInscritos')),
        array('name' => 'fecha_apertura', 'filter' => false),
        array('name' => 'fecha_cierre', 'filter' => false),
        //'creador',
        //'cupos',
        array('name' => 'estado',
            'value' => array($this, 'gridEstado'),
            'filter'=>false
            //'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado=:id', array('id' => TipoEstado::$INSCRIPCION)), 'id_estado', 'nombre')
            ),
        /*
          'descripcion',
          'campus',

          'requisitos',
          'horario',
          'fecha_creacion',
          'adjunto',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {inscribir}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Detalle',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                ),
                'inscribir' => array(
                    'label' => 'Inscribir',
                     'url' => "CHtml::normalizeUrl(array('inscribe', 'id'=>\$data->id_inscripcion))",
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                ),
            ),
        ),
    ),
));
?>
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