<?php
/* @var $this AdjuntoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Adjuntos',
);

$this->menu=array(
	array('label'=>'Create Adjunto', 'url'=>array('create')),
	array('label'=>'Manage Adjunto', 'url'=>array('admin')),
);
?>

<h1>Adjuntos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
