<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */

$this->breadcrumbs=array(
	'Solicitudes',
	'Modificar',
);


?>

<h1>Modificar Solicitud</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>