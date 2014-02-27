<?php
/* @var $this DiaController */
/* @var $model Dia */

$this->breadcrumbs=array(
	'Dias'=>array('index'),
	$model->id_dia=>array('view','id'=>$model->id_dia),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dia', 'url'=>array('index')),
	array('label'=>'Create Dia', 'url'=>array('create')),
	array('label'=>'View Dia', 'url'=>array('view', 'id'=>$model->id_dia)),
	array('label'=>'Manage Dia', 'url'=>array('admin')),
);
?>

<h1>Update Dia <?php echo $model->id_dia; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>