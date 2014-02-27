<?php
/* @var $this NivelController */
/* @var $model Nivel */

$this->breadcrumbs=array(
	'Administrador de horarios'=>array('admin'),
	'Crear nuevo horario',
);

$this->menu=array(
	//array('label'=>'List Nivel', 'url'=>array('index')),
	array('label'=>'Volver al administrador de horarios', 'url'=>array('admin')),
);
?>

<h1>Crear Horario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>