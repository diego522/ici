<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */

$this->breadcrumbs=array(
	'Administrador de Inscripciones'=>array('admin'),
	'Detalle'=>array('view','id'=>$model->id_inscripcion),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'List Inscripcion', 'url'=>array('index')),
	//a/rray('label'=>'Create Inscripcion', 'url'=>array('create')),
	//array('label'=>'View Inscripcion', 'url'=>array('view', 'id'=>$model->id_inscripcion)),
	array('label'=>'Administrador de Inscripciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Inscripción </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>