<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	'Nuevo equipo',
);

/*$this->menu=array(
	array('label'=>'List Equipo', 'url'=>array('index')),
	array('label'=>'Manage Equipo', 'url'=>array('admin')),
);*/
?>

<h1>Nuevo Equipo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>