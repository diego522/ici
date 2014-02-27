<?php
/* @var $this AdjuntoController */
/* @var $model Adjunto */

$this->breadcrumbs=array(
	'Adjuntos'=>array('index'),
	$model->id_adjunto=>array('view','id'=>$model->id_adjunto),
	'Update',
);

$this->menu=array(
	array('label'=>'List Adjunto', 'url'=>array('index')),
	array('label'=>'Create Adjunto', 'url'=>array('create')),
	array('label'=>'View Adjunto', 'url'=>array('view', 'id'=>$model->id_adjunto)),
	array('label'=>'Manage Adjunto', 'url'=>array('admin')),
);
?>

<h1>Update Adjunto <?php echo $model->id_adjunto; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>