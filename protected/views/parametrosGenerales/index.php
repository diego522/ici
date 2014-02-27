<?php
/* @var $this ParametrosGeneralesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Parametros Generales',
);

$this->menu=array(
	array('label'=>'Create ParametrosGenerales', 'url'=>array('create')),
	array('label'=>'Manage ParametrosGenerales', 'url'=>array('admin')),
);
?>

<h1>Parametros Generales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
