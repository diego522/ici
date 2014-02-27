


<?php
/* @var $this SolicitudController */
/* @var $model Solicitud */
/* @var $form CActiveForm */
?>



<h1>Resolver situación de solicitud</h1>
<div class="iconosdescarga">
    <?php echo CHtml::link('<img align="middle" title="Descarga esta solicitud en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>', array('verPDF', 'id' => $model->id_solicitud,)); ?>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_solicitud',

        array('name' => 'tipo_solicitud',
            'value' => $model->tipoSolicitud->nombre),
        array('name' => 'id_alumno',
            'value' => $model->idAlumno->nombre.', '.$model->idAlumno->username),
        array('name' => 'estado',
            'value' => $model->estado0->nombre),
      /*  array('name' => 'motivo',
            'type' => 'raw'),*/
    ),
));
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'solicitud-form',
        'enableAjaxValidation' => true,
             'clientOptions' => array(
              'validateOnSubmit' => true,) 
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'estado'); ?>
        <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado='.TipoEstado::$SOLICITUD), 'id_estado', 'nombre'), array('empty' => 'Seleccione')); ?> 
        <?php echo $form->error($model, 'estado'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'motivo_rechazo'); ?>
        <?php echo $form->textArea($model, 'motivo_rechazo', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'motivo_rechazo'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar y notificar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->