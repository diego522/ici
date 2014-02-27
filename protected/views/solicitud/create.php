<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */

$this->breadcrumbs=array(
	'Solicitudes',
	'Nueva solicitud',
);

?>

<h1>Nueva Solicitud</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>