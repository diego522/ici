<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'horario-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>




    <div class="row">
        <?php echo $form->labelEx($model, 'id_ramo'); ?>
        <?php echo CHtml::activeDropDownList($model, 'id_ramo', Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus')), array('empty' => 'Seleccione')); ?> 
        <?php echo $form->error($model, 'id_ramo'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'sala'); ?>
        <?php echo $form->textField($model, 'sala', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'sala'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->