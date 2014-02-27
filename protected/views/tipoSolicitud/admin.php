<?php
/* @var $this TipoSolicitudController */
/* @var $model TipoSolicitud */

$this->breadcrumbs = array(
    'Tipo Solicituds' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List TipoSolicitud', 'url' => array('index')),
    array('label' => 'Create TipoSolicitud', 'url' => array('create')),
);


?>

<h1>Administrar Tipos de Solicitud</h1>



<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tipo-solicitud-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_tipo',
        'nombre',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => 'Yii::app()->createUrl("equipo/viewEquipo", array("id"=>$data->id_equipo))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
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
