<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */

$this->breadcrumbs = array(
    'Administrador de Solicitudes' => array('admin'),
);
?>

<h1>Administrar Solicitudes</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'solicitud-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'rowCssClassExpression'=>'$data->cssClassStyle()',
    'columns' => array(
        'id_solicitud',
        array('name' => 'tipo_solicitud',
            'filter' => CHtml::listData(TipoSolicitud::model()->findAll(), 'id_tipo', 'nombre'),
        'value' => array($this, 'gridTipoSolicitud')),
        array('name' => 'estado',
            'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado='.TipoEstado::$SOLICITUD), 'id_estado', 'nombre'),
            'value' => array($this, 'gridEstado')),
        array('name' => 'nombre',
            //'filter' => ,
            'value' => array($this, 'gridAlumno')),
        array('name'=>'fecha_creacion',
            'filter'=>false),
        array('name' => 'id_periodo',
            'filter' => CHtml::listData(Periodo::model()->findAll('campus='.Yii::app()->user->getState('campus')), 'id_periodo', 'titulo'),
            'value' => array($this, 'gridPeriodo')),
        
        //'motivo',
        
        //'adjunto',
       
        /*
          'fecha_creacion',
          'motivo_rechazo',
          'id_periodo',
          'fecha_resolucion',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {resolver}',
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
                'resolver' => array(
                    'label' => 'Resolver situación',
                     'url' => "CHtml::normalizeUrl(array('resolverSituacion', 'id'=>\$data->id_solicitud))",
                     'options' => array('id' => 'inline')
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
    // 'onComplete' => 'function(){tinyMCE_setup();}',
    ),
        )
);
?>