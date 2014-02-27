<?php
/* @var $this PeriodoController */
/* @var $model Periodo */

$this->breadcrumbs = array(
    'Administrador de Periodos de solicitudes' => array('admin'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Periodo', 'url'=>array('index')),
    array('label' => 'Nuevo Periodo', 'url' => array('create')),
);
?>

<h1>Administrar periodos de solicitudes</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'periodo-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_periodo',
        'titulo',
        //'id_tipo_proceso',
        'fecha_apertura',
        'fecha_cierre',
        'fecha_creacion',
        array('name' => 'estado',
            'value' => array($this, 'gridEstado'),
        ),
        /*
          'campus',
          'titulo',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => "CHtml::normalizeUrl(array('view', 'id'=>\$data->id_propuesta))",
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
