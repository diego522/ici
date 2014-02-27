<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	$model->id_horario,
);

$this->menu=array(
	array('label'=>'List Horario', 'url'=>array('index')),
	array('label'=>'Create Horario', 'url'=>array('create')),
	array('label'=>'Update Horario', 'url'=>array('update', 'id'=>$model->id_horario)),
	array('label'=>'Delete Horario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_horario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Horario', 'url'=>array('admin')),
);
?>

<h1>View Horario #<?php echo $model->id_horario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_horario',
		'id_nivel',
		'id_ramo',
		'id_dia',
		'id_bloque',
		'id_usuario',
		'fecha_actualizacion',
		'fecha_creacion',
		'campus',
		'sala',
		'descripcion',
	),
)); ?>
