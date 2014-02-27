

<h1>Equipo <?php echo $model->nombre; ?> </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_equipo',
        'nombre',
        array('name' => 'estado',
            'value' => $model->estado ? Estados::model()->findByPk($model->estado)->nombre : 'Participante',
        ),
        array('name' => 'fecha_presentacion',
            'value' => Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fecha_presentacion))),
        array('name' => 'participantes',
            'type' => 'raw',
            'value' => $lista,),
        array('name' => 'Propuesta en B/N', 'type' => 'raw', 'value' => $model->adjunto_bn ? Adjunto::model()->findByPk($model->adjunto_bn)->nombre : 'no hay archivo'),
        array('name' => 'Propuesta en Color', 'type' => 'raw', 'value' => $model->adjunto_color ? Adjunto::model()->findByPk($model->adjunto_color)->nombre : 'no hay archivo'),
    ),
));
?>
