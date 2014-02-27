<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs = array(
    'Noticias' => array('index'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Noticia', 'url'=>array('index')),
    array('label' => 'Nueva Noticia', 'url' => array('create')),
);
?>

<h1>Administrar Noticias</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'noticia-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_noticia',
        'titulo',
        //'contenido',
        //'creador',
        'fecha_actualizacion',
        'fecha_creacion',
        /*
          'estado',
          'campus',
          'prioridad',
         */
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
