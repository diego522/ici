<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Nuevo',
);


?>

<h1>Nuevo Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>