<?php
/* @var $this PeriodoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Periodos',
);

$this->menu=array(
	array('label'=>'Create Periodo', 'url'=>array('create')),
	array('label'=>'Manage Periodo', 'url'=>array('admin')),
);
?>

<h1>Periodos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
