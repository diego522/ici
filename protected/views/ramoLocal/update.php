<?php
/* @var $this RamoLocalController */
/* @var $model RamoLocal */

$this->breadcrumbs=array(
	'Ramo Locals'=>array('index'),
	$model->id_ramo=>array('view','id'=>$model->id_ramo),
	'Update',
);

$this->menu=array(
	array('label'=>'List RamoLocal', 'url'=>array('index')),
	array('label'=>'Create RamoLocal', 'url'=>array('create')),
	array('label'=>'View RamoLocal', 'url'=>array('view', 'id'=>$model->id_ramo)),
	array('label'=>'Manage RamoLocal', 'url'=>array('admin')),
);
?>

<h1>Update RamoLocal <?php echo $model->id_ramo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>