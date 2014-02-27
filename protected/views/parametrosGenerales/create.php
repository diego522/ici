<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */

$this->breadcrumbs=array(
	'Parametros Generales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParametrosGenerales', 'url'=>array('index')),
	array('label'=>'Manage ParametrosGenerales', 'url'=>array('admin')),
);
?>

<h1>Create ParametrosGenerales</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>