<?php
/* @var $this RamoLocalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ramo Locals',
);

$this->menu=array(
	array('label'=>'Create RamoLocal', 'url'=>array('create')),
	array('label'=>'Manage RamoLocal', 'url'=>array('admin')),
);
?>

<h1>Ramo Locals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
