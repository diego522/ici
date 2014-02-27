<?php
/* @var $this SolicitudController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mis Solicitudes',
);

$this->menu=array(
	array('label'=>'Nueva Solicitud', 'url'=>array('create')),
);
?>

<h1>Mi historial de solicitudes</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'solicitud-grid',
    'dataProvider' => $model->searchMisSolicitudes(),
    'filter' => $model,
    'columns' => array(
        'id_solicitud',
        array('name' => 'tipo_solicitud',
            'filter' => CHtml::listData(TipoSolicitud::model()->findAll(), 'id_tipo', 'nombre'),
        'value' => array($this, 'gridTipoSolicitud')),
        array('name' => 'estado',
            'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado='.TipoEstado::$SOLICITUD), 'id_estado', 'nombre'),
            'value' => array($this, 'gridEstado')),
        array('name' => 'nombre',
            'filter' => FALSE,
            'value' => array($this, 'gridAlumno')),
        array('name'=>'fecha_creacion',
            'filter'=>false),
        array('name' => 'id_periodo',
            'filter' => CHtml::listData(Periodo::model()->findAll('campus='.Yii::app()->user->getState('campus')), 'id_periodo', 'titulo'),
            'value' => array($this, 'gridPeriodo')),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
                'update' => array(
                    'label' => 'Editar',
                    //'url' => "CHtml::normalizeUrl(array('update', 'id'=>\$data->id_propuesta))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                ),
                'delete' => array(
                    'label' => 'Borrar',
                    // 'url' => "CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_propuesta))",
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
    // 'onComplete' => 'function(){tinyMCE_setup();}',
    ),
        )
);
?>
