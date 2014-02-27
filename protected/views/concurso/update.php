<?php
/* @var $this ConcursoController */
/* @var $model Concurso */

$this->breadcrumbs=array(
	'Concursos'=>array('index'),
	$model->id_concurso=>array('view','id'=>$model->id_concurso),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Lista de Concursos', 'url'=>array('index')),
	array('label'=>'Nuevo Concurso', 'url'=>array('create')),
	array('label'=>'Ver Concurso', 'url'=>array('view', 'id'=>$model->id_concurso)),
	array('label'=>'Administrar Concursos', 'url'=>array('admin')),
);
?>

<h1>Modificar Concurso <?php echo $model->id_concurso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>