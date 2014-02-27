<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	'Nueva noticia',
);


?>

<h1>Nueva Noticia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>