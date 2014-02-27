<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */

$this->breadcrumbs=array(
	'Administrar Inscripciones'=>array('admin'),
	'Nueva inscripcion',
);

$this->menu=array(
	//array('label'=>'List Inscripcion', 'url'=>array('index')),
	array('label'=>'Administrador de Inscripciones', 'url'=>array('admin')),
);
?>

<h1>Nueva Inscripción</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>