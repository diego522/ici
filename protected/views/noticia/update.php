<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	'Noticia'=>array('view','id'=>$model->id_noticia),
	'Actualizar',
);


?>

<h1>Actualizar Noticia </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>