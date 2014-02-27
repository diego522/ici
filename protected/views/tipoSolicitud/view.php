<?php
/* @var $this TipoSolicitudController */
/* @var $model TipoSolicitud */

$this->breadcrumbs=array(
	'Tipo Solicituds'=>array('index'),
	$model->id_tipo,
);

$this->menu=array(
	array('label'=>'List TipoSolicitud', 'url'=>array('index')),
	array('label'=>'Create TipoSolicitud', 'url'=>array('create')),
	array('label'=>'Update TipoSolicitud', 'url'=>array('update', 'id'=>$model->id_tipo)),
	array('label'=>'Delete TipoSolicitud', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoSolicitud', 'url'=>array('admin')),
);
?>

<h1>View TipoSolicitud #<?php echo $model->id_tipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo',
		'nombre',
	),
)); ?>
