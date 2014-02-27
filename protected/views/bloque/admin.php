<?php
/* @var $this BloqueController */
/* @var $model Bloque */

$this->breadcrumbs=array(
	'Bloques'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Bloque', 'url'=>array('index')),
	array('label'=>'Create Bloque', 'url'=>array('create')),
);


?>

<h1>Administrar Bloques</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bloque-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_bloque',
		'hora_inicio',
		'hora_fin',
		array(
			'class'=>'CButtonColumn',
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
)); ?>
