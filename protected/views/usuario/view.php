<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs = array(
    'Usuarios' => array('admin'),
    'Detalle del usuario',
);

$this->menu = array(
    array('label' => 'Actualizar Usuario', 'url' => array('update', 'id' => $model->id_usuario)),
    array('label' => 'Eliminar Usuario', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_usuario), 'confirm' => 'seguro que desea eliminar este item?'),'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
);
?>

<h1>Detalle de Usuario </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_usuario',
        'nombre',
        'username',
        //'dv',
        //'password',
        //'apellido',
        array('name' => 'id_rol',
            'value' => $model->idRol->nombre),
        'email',
        'direccion',
        'telefono',
        array('name' => 'campus',
            'value' => $model->campus ? $model->campus == '1' ? 'Concepción' : 'Chillán' : '')
    ),
));
?>
