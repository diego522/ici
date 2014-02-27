<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */

$this->breadcrumbs = array(
    'Administrador de Preinscripciones' => array('admin'),
    'Detalle' => array('view', 'id' => $model->id_preinscripcion),
    'Actualizar',
);
?>

<h1>Modificar Preinscripción</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>