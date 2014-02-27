<?php
/* @var $this TipoEstadoController */
/* @var $model TipoEstado */

$this->breadcrumbs = array(
    'Tipos de Estados' => array('admin'),
    'Administrar',
);

$this->menu = array(
    //array('label' => 'List TipoEstado', 'url' => array('index')),
    array('label' => 'Nuevo Tipo de Estado', 'url' => array('create')),
);


?>

<h1>Administrar Tipos de Estados</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tipo-estado-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_tipo_estado',
        'nombre',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} ',
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
