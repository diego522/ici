<?php
/* @var $this PeriodoController */
/* @var $model Periodo */

$this->breadcrumbs = array(
    'Periodos' => array('admin'),
    $model->titulo,
);

$this->menu = array(
    //array('label'=>'List Periodo', 'url'=>array('index')),
    //array('label'=>'Create Periodo', 'url'=>array('create')),
    array('label' => 'Modificar Periodo', 'url' => array('update', 'id' => $model->id_periodo)),
    //array('label'=>'Delete Periodo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_periodo),'confirm'=>'Are you sure you want to delete this item?')),
    array('label' => 'Administrar Periodos', 'url' => array('admin')),
);
?>

<h1>Detalle Periodo </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_periodo',
        'titulo',
        array('name' => 'estado',
            'value' => $model->estado0->nombre),
        'fecha_creacion',
        'fecha_apertura',
        'fecha_cierre',
    //'estado',
    //'campus',
    ),
));
?>
