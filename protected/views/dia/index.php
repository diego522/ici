<?php
/* @var $this DiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dias',
);

$this->menu=array(
	array('label'=>'Create Dia', 'url'=>array('create')),
	array('label'=>'Manage Dia', 'url'=>array('admin')),
);
?>

<h1>Dias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
