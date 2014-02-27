<?php
/* @var $this ConcursoController */
/* @var $model Concurso */

$this->breadcrumbs=array(
	'Concursos'=>array('admin'),
	'Crear',
);


?>

<h1>Nuevo Concurso</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>