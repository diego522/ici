<?php
/* @var $this RamoLocalController */
/* @var $model RamoLocal */

$this->breadcrumbs=array(
	'Ramo Locals'=>array('index'),
	$model->id_ramo,
);

$this->menu=array(
	array('label'=>'List RamoLocal', 'url'=>array('index')),
	array('label'=>'Create RamoLocal', 'url'=>array('create')),
	array('label'=>'Update RamoLocal', 'url'=>array('update', 'id'=>$model->id_ramo)),
	array('label'=>'Delete RamoLocal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_ramo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RamoLocal', 'url'=>array('admin')),
);
?>

<h1>View RamoLocal #<?php echo $model->id_ramo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_ramo',
		'agn_nombre',
	),
)); ?>
