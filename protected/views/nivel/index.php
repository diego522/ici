<?php
/* @var $this NivelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Horarios',
);

?>

<h1>Horarios Vigentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
