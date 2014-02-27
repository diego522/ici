<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	$model->id_horario=>array('view','id'=>$model->id_horario),
	'Update',
);

$this->menu=array(
	array('label'=>'List Horario', 'url'=>array('index')),
	array('label'=>'Create Horario', 'url'=>array('create')),
	array('label'=>'View Horario', 'url'=>array('view', 'id'=>$model->id_horario)),
	array('label'=>'Manage Horario', 'url'=>array('admin')),
);
?>

<h1>Modificar espacio de Horario </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>