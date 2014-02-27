<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs = array(
    'Estados' => array('admin'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Estado', 'url'=>array('index')),
    array('label' => 'Nuevo Estado', 'url' => array('create')),
);
?>

<h1>Administrar Estados</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'estado-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_estado',
        array('name' => 'id_tipo_estado',
            'value' => array($this, 'gridTipoEstado'),
            'filter' => CHtml::listData(TipoEstado::model()->findAll(), 'id_tipo_estado', 'nombre')
        ),
        'nombre',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} ',
            //'template' => '{view} {update} {delete}',
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
