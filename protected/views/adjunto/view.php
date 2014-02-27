<?php
/* @var $this AdjuntoController */
/* @var $model Adjunto */

$this->breadcrumbs=array(
	'Adjuntos'=>array('index'),
	$model->id_adjunto,
);

$this->menu=array(
	array('label'=>'List Adjunto', 'url'=>array('index')),
	array('label'=>'Create Adjunto', 'url'=>array('create')),
	array('label'=>'Update Adjunto', 'url'=>array('update', 'id'=>$model->id_adjunto)),
	array('label'=>'Delete Adjunto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_adjunto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adjunto', 'url'=>array('admin')),
);
?>

<h1>View Adjunto #<?php echo $model->id_adjunto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_adjunto',
		'nombre',
		'ruta',
		'tipo',
		'creador',
		'fecha_creacion',
	),
)); ?>
