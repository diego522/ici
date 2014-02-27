<?php
/* @var $this TipoEstadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Estados',
);

$this->menu=array(
	array('label'=>'Create TipoEstado', 'url'=>array('create')),
	array('label'=>'Manage TipoEstado', 'url'=>array('admin')),
);
?>

<h1>Tipo Estados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
