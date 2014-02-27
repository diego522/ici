<?php
/* @var $this ConcursoController */
/* @var $model Concurso */

$this->breadcrumbs = array(
    'Concursos' => array('index'),
    $model->nombre,
);
if (Yii::app()->user->checkAccess(Rol::$ADMINISTRADOR) || Yii::app()->user->checkAccess(Rol::$SUPER_USUARIO)) {
    $this->menu = array(
        //array('label' => 'Lista de Concursos', 'url' => array('index')),
        array('label' => 'Lista de Equipos', 'url' => array('equipo/index','idc'=>$model->id_concurso)),
        //array('label' => 'Nuevo Concurso', 'url' => array('create')),
        array('label' => 'Modificar Concurso', 'url' => array('update', 'id' => $model->id_concurso)),
       // array('label' => 'Eliminar Concurso', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_concurso), 'confirm' => 'Seguro que quieres eliminar este item?')),
       // array('label' => 'Administrar Concursos', 'url' => array('admin')),
    );
}
?>

<h1>Detalle del Concurso <?php //echo $model->id_concurso;  ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        /* 'id_concurso', */
        'nombre',
        array('name' => 'descripcion',
            'type' => 'raw',
            'value' => $model->descripcion),
        'max_participantes',
        array('name' => 'fechaCreacion',
            'value' => Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fechaCreacion))),
        array('name' => 'fechaApertura',
            'value' => Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fechaApertura))),
        array('name' => 'fechaCierre',
            'value' => Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fechaCierre))),
       array('name' => 'estado',
            'value' =>$model->estado0->nombre,),
        array('name' => 'Acción', 'type' => 'raw', 'value' => $model->verificaDisponibilidadDePlazo() ? CHtml::link('Participar', array('equipo/create', 'id' => $model->id_concurso)) : 'No disponible',),
        array('name' => 'Bases', 'type' => 'raw', 'value' => $model->verificaDisponibilidadDePlazo() ? CHtml::link('Descargar', array('download', 'id' => $model->id_concurso)) : 'No disponible',)
    ),
));
?>


