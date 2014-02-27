<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */

$this->breadcrumbs=array(
	'Parametros Generales'=>array('admin'),
	//$model->id_parametros_generales=>array('view','id'=>$model->id_parametros_generales),
	'Modificar',
);


?>

<h1>Modificar Parametros Generales </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>