<?php
/* @var $this DiaController */
/* @var $model Dia */

$this->breadcrumbs=array(
	'Dias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dia', 'url'=>array('index')),
	array('label'=>'Manage Dia', 'url'=>array('admin')),
);
?>

<h1>Create Dia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>