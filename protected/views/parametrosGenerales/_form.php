<?php
/* @var $this ParametrosGeneralesController */
/* @var $model ParametrosGenerales */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'parametros-generales-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre_jefe_carrera'); ?>
        <?php echo $form->textField($model, 'nombre_jefe_carrera', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'nombre_jefe_carrera'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'correo_jefe_carrera'); ?>
        <?php echo $form->textField($model, 'correo_jefe_carrera', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'correo_jefe_carrera'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre_director_departamento'); ?>
        <?php echo $form->textField($model, 'nombre_director_departamento', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'nombre_director_departamento'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'correo_director_departamento'); ?>
        <?php echo $form->textField($model, 'correo_director_departamento', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'correo_director_departamento'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'correo_secretaria'); ?>
        <?php echo $form->textField($model, 'correo_secretaria', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'correo_secretaria'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->