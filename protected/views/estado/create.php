<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	'Estados'=>array('admin'),
	'Nuevo',
);


?>

<h1>Nuevo Estado</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>