<?php
/* @var $this TipoEstadoController */
/* @var $model TipoEstado */

$this->breadcrumbs=array(
	'Tipos de estados'=>array('admin'),
	'Tipo de estado'=>array('view','id'=>$model->id_tipo_estado),
	'Modificar',
);


?>

<h1>Modificar Tipo de Estado</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>