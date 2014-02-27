<?php
/* @var $this NoticiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Noticias',
);

?>

<h1>Noticias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
