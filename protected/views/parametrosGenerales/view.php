<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */

$this->breadcrumbs = array(
    'Parametros Generales' => array('admin'),
    'Detalles',
);

$this->menu = array(
    array('label' => 'Actualizar Parametros Generales', 'url' => array('update', 'id' => $model->id_parametros_generales)),
    array('label' => 'Administrar Parametros Generales', 'url' => array('admin')),
);
?>

<h1>Detalles de los Parametros Generales </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_parametros_generales',
        //'campus',
        array('name'=>'nombre_jefe_carrera',),
        array('name'=>'correo_jefe_carrera',),
        array('name'=>'nombre_director_departamento',),
        array('name'=>'correo_director_departamento',),
        array('name'=>'correo_secretaria',),
    ),
));
?>
