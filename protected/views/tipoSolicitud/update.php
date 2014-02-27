<?php
/* @var $this TipoSolicitudController */
/* @var $model TipoSolicitud */

$this->breadcrumbs=array(
	'Tipo Solicituds'=>array('index'),
	$model->id_tipo=>array('view','id'=>$model->id_tipo),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoSolicitud', 'url'=>array('index')),
	array('label'=>'Create TipoSolicitud', 'url'=>array('create')),
	array('label'=>'View TipoSolicitud', 'url'=>array('view', 'id'=>$model->id_tipo)),
	array('label'=>'Manage TipoSolicitud', 'url'=>array('admin')),
);
?>

<h1>Update TipoSolicitud <?php echo $model->id_tipo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>