<?php
/* @var $this ConcursoController */
/* @var $model Concurso */

$this->breadcrumbs = array(
    'Concursos' => array('index'),
    'Administrar',
);

$this->menu = array(
    // array('label' => 'Lista de Concursos', 'url' => array('index')),
    array('label' => 'Nuevo Concurso', 'url' => array('create')),
);
?>

<h1>Administrar Concursos</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'concurso-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_concurso',
        'nombre',
        /* 'descripcion', */
        array('name' => 'fechaCreacion',
            'value' => 'Yii::app()->dateFormatter->format("dd/MM/y hh:mm",strtotime($data->fechaCreacion))',
            'filter' => false),
        array('name' => 'fechaApertura',
            'value' => 'Yii::app()->dateFormatter->format("dd/MM/y hh:mm",strtotime($data->fechaApertura))',
            'filter' => false),
        array('name' => 'fechaCierre',
            'value' => 'Yii::app()->dateFormatter->format("dd/MM/y hh:mm",strtotime($data->fechaCierre))',
            'filter' => false),
        /*
          'adjunto', */
        array('name' => 'estado',
            'value' => array($this, 'gridNombreEstado'),
            'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado=:idtipo', array('idtipo' => 8)), 'id_estado', 'nombre')),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => "CHtml::normalizeUrl(array('view', 'id'=>\$data->id_propuesta))",
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
