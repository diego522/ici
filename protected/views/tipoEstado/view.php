<?php
/* @var $this TipoEstadoController */
/* @var $model TipoEstado */

$this->breadcrumbs=array(
	'Tipo Estados'=>array('admin'),
	'Ver',
);

$this->menu=array(
	//array('label'=>'List TipoEstado', 'url'=>array('index')),
	//array('label'=>'Create TipoEstado', 'url'=>array('create')),
	array('label'=>'Modificar Tipo de Estado', 'url'=>array('update', 'id'=>$model->id_tipo_estado)),
	//array('label'=>'Delete TipoEstado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo_estado),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage TipoEstado', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo de Estado </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo_estado',
		'nombre',
	),
)); ?>
