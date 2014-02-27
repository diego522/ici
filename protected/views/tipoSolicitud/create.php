<?php
/* @var $this TipoSolicitudController */
/* @var $model TipoSolicitud */

$this->breadcrumbs=array(
	'Tipo Solicituds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoSolicitud', 'url'=>array('index')),
	array('label'=>'Manage TipoSolicitud', 'url'=>array('admin')),
);
?>

<h1>Create TipoSolicitud</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>