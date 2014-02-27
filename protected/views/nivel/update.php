<?php
/* @var $this NivelController */
/* @var $model Nivel */

$this->breadcrumbs=array(
	'Administrador de horarios'=>array('admin'),
	$model->nombre=>array('view','id'=>$model->id_nivel),
	'Modificar',
);

$this->menu=array(
	//array('label'=>'List Nivel', 'url'=>array('index')),
	//array('label'=>'Create Nivel', 'url'=>array('create')),
	//array('label'=>'View Nivel', 'url'=>array('view', 'id'=>$model->id_nivel)),
	array('label'=>'Volver al administrador de horarios', 'url'=>array('admin')),
);
?>

<h1>Modificar Horario <?php echo $model->nombre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>