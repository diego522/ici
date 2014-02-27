<?php
/* @var $this AdjuntoController */
/* @var $model Adjunto */

$this->breadcrumbs=array(
	'Adjuntos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Adjunto', 'url'=>array('index')),
	array('label'=>'Manage Adjunto', 'url'=>array('admin')),
);
?>

<h1>Create Adjunto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>