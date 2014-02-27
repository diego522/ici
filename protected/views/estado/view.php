<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs = array(
    'Estados' => array('admin'),
    $model->nombre,
);

$this->menu = array(
    //array('label'=>'List Estado', 'url'=>array('index')),
    //array('label'=>'Create Estado', 'url'=>array('create')),
    array('label' => 'Modificar Estado', 'url' => array('update', 'id' => $model->id_estado)),
        //array('label'=>'Delete Estado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_estado),'confirm'=>'Are you sure you want to delete this item?')),
        //array('label'=>'Manage Estado', 'url'=>array('admin')),
);
?>

<h1>Detalle Estado </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_estado',
        array('name' => 'id_tipo_estado',
            'value' => $model->idTipoEstado->nombre),
        'nombre',
    ),
));
?>
