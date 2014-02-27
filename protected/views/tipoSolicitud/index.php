<?php
/* @var $this TipoSolicitudController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Solicituds',
);

$this->menu=array(
	array('label'=>'Create TipoSolicitud', 'url'=>array('create')),
	array('label'=>'Manage TipoSolicitud', 'url'=>array('admin')),
);
?>

<h1>Tipo Solicituds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
