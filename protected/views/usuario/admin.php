<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs = array(
    'Usuarios' => array('admin'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Usuario', 'url'=>array('index')),
    array('label' => 'Nuevo Usuario', 'url' => array('create')),
    array('label' => 'Importar Usuario desde UBB', 'url' => array('importarDesdeUBB',), 'linkOptions' => array('id' => 'inline')),
);
?>
<h1>Administrar Usuarios</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'usuario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_usuario',
        'nombre',
        array('name' => 'username'),
        //'dv',
        //'password',
        //'apellido',
        array('name' => 'id_rol',
            'value' => array($this, 'gridRol'),
            'filter' => CHtml::listData(Rol::model()->findAll(), 'id_rol', 'nombre'),
        ),
       // 'email',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => false,
    ),
        )
);
?>