<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Usuario'=>array('view','id'=>$model->id_usuario),
	'Actualizar',
);


?>

<h1>Actualizar Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>