<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */

$this->breadcrumbs = array(
    'Inscripciones de propósito general',
);
?>

<h1>Mis Inscripciones</h1>

<?php


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'inscripcion-grid',
    'dataProvider' => $model->searchMisInscripciones(),
    'filter' => $model,
    'columns' => array(
        //'id_inscripcion',
        'actividad',
        array('name' => 'fecha_apertura', 'filter' => false),
        array('name' => 'fecha_cierre', 'filter' => false),
        //'creador',
        //'cupos',
        array('name' => 'estado',
            'value' => array($this, 'gridEstado'),
            'filter' => false
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
            'template' => '{view} {renunciar}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Detalle',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                ),
                'renunciar' => array(
                    'label' => 'Renunciar',
                    'url' => "CHtml::normalizeUrl(array('renuncia', 'id'=>\$data->id_inscripcion))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
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