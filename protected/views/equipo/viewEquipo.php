<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs = array(
    'Equipos',
    $model->nombre,
);

?>

<h1>Equipo <?php echo $model->nombre; ?> </h1>
<?php echo CHtml::link('<img align="middle" title="Descarga en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>', array('viewEquipoPDF', 'id' => $model->id_equipo)); ?>
<?php echo CHtml::link('<img align="middle" title="Modificar" src="' . Yii::app()->request->baseUrl . '/images/edit_icon.png"/>', array('update', 'id' => $model->id_equipo)); ?>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
         'id_equipo',
        'nombre',
        array('name'=>'estado',
            'value'=>$model->estado?Estados::model()->findByPk($model->estado)->nombre:'participante',
            ),
        array('name'=>'fecha_presentacion',
            'value'=>Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fecha_presentacion))),
        array('name' => 'participantes',
            'type' => 'raw',
            'value' => $lista,),
        array('name' => 'Propuesta en B/N', 'type' => 'raw', 'value' => $model->adjunto_bn ? CHtml::link('Descargar', array('equipo/download', 'id' => $model->adjunto_bn,)) : 'no hay accion'),
        array('name' => 'Propuesta en Color', 'type' => 'raw', 'value' => $model->adjunto_color ? CHtml::link('Descargar', array('equipo/download', 'id' => $model->adjunto_color,)) : 'no hay accion'),
    ),
));
?>
