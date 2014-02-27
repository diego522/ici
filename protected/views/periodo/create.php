<?php
/* @var $this PeriodoController */
/* @var $model Periodo */

$this->breadcrumbs=array(
	'Periodos'=>array('admin'),
	'Nuevo',
);


?>

<h1>Nuevo Periodo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>