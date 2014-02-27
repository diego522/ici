<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */

$this->breadcrumbs=array(
	'Administrador de Preinscripciones'=>array('admin'),
	'Nueva',
);


?>

<h1>Nueva Preinscripción de electivo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>