<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */

$this->breadcrumbs = array(
    'Parametros Generales' => array('admin'),
    'Administrar',
);
?>

<h1>Listado de parametros generales</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'parametros-generales-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
       // 'id_parametros_generales',
        //'campus',
        array('name'=>'correo_jefe_carrera','filter'=>false),
        array('name'=>'nombre_jefe_carrera','filter'=>false),
        array('name'=>'correo_director_departamento','filter'=>false),
        array('name'=>'nombre_director_departamento','filter'=>false),
        array('name'=>'correo_secretaria','filter'=>false),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} ',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => "CHtml::normalizeUrl(array('view', 'id'=>\$data->id_parametros_generales))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
                'update' => array(
                    'label' => 'Editar',
                    //'url' => "CHtml::normalizeUrl(array('update', 'id'=>\$data->id_parametros_generales))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                ),
            ),
        ),
    ),
));
?>
