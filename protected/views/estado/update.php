<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	'Estados'=>array('admin'),
	$model->nombre=>array('view','id'=>$model->id_estado),
	'Modificar',
);


?>

<h1>Modificar Estado</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>