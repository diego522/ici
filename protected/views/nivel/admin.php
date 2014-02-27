<?php
/* @var $this NivelController */
/* @var $model Nivel */

$this->breadcrumbs = array(
    'Administrador de horarios' => array('admin'),
);

$this->menu = array(
    //  array('label' => 'List Nivel', 'url' => array('index')),
    array('label' => 'Crear Horario', 'url' => array('create')),
);
?>

<h1>Administrador de Horarios</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'nivel-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_nivel',
        'nombre',
        //'campus',
        array('name' => 'estado','value'=>array($this,'gridEstado'),'filter'=>CHtml::listData(Estado::model()->findAll('id_tipo_estado='.TipoEstado::$NIVEL), 'id_estado', 'nombre')),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {editar}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
                'editar' => array(
                    'label' => 'Editar',
                     'url' => 'Yii::app()->createUrl("nivel/editarHorario", array("id"=>$data->id_nivel))',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
                'update' => array(
                    'label' => 'Editar',
                    //'url' => "CHtml::normalizeUrl(array('update', 'id'=>\$data->id_propuesta))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                ),
                'delete' => array(
                    'label' => 'Borrar',
                    // 'url' => "CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_propuesta))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                ),
            ),
        ),
    ),
));
?>
