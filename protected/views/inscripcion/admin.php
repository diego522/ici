<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */

$this->breadcrumbs = array(
    'Administrador de inscripciones' => array('admin'),
);

$this->menu = array(
    array('label' => 'Nueva Inscripción', 'url' => array('create')),
);
?>

<h1>Administrar Inscripciones de Propósito General</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'inscripcion-grid',
    'dataProvider' => $model->search(),
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
            'value' => array($this, 'gridEstado'), 'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado=:id', array('id' => TipoEstado::$INSCRIPCION)), 'id_estado', 'nombre')),
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
            'template' => '{view} {update} {delete} {listado} {excel} {admin}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Detalle',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                ),
                'update' => array(
                    'label' => 'Modificar',
                    //'url' => "CHtml::normalizeUrl(array('renuncia', 'id'=>\$data->id_inscripcion))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                ),
                'delete' => array(
                    'label' => 'Eliminar',
                    //'url' => "CHtml::normalizeUrl(array('renuncia', 'id'=>\$data->id_inscripcion))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                ),
                'listado' => array(
                    'label' => 'Listado',
                    'url' => "CHtml::normalizeUrl(array('ListadoPDF', 'id'=>\$data->id_inscripcion))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/pdf_icon.png',
                ),
                'excel' => array(
                    'label' => 'Listado',
                    'url' => "CHtml::normalizeUrl(array('ListadoExcel', 'id'=>\$data->id_inscripcion))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/xls_icon.png',
                ),
                'admin' => array(
                    'label' => 'Administrar',
                    'url' => "CHtml::normalizeUrl(array('AdministrarUnaInscricion', 'id'=>\$data->id_inscripcion))",
                //'imageUrl' => Yii::app()->request->baseUrl . '/images/pdf_icon.png',
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