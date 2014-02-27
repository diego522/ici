<?php
/* @var $this RamoLocalController */
/* @var $model RamoLocal */

$this->breadcrumbs=array(
	'Ramo Locals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RamoLocal', 'url'=>array('index')),
	array('label'=>'Manage RamoLocal', 'url'=>array('admin')),
);
?>

<h1>Crear un electivo de manera local</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>