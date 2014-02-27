<?php
/* @var $this PeriodoController */
/* @var $model Periodo */

$this->breadcrumbs = array(
    'Administrador de Periodos de solicitudes' => array('admin'),
    'Periodo' => array('view', 'id' => $model->id_periodo),
    'Modificar',
);
?>

<h1>Modifiar Periodo</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>