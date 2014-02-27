<?php
/* @var $this EstadoController */
/* @var $model Estado */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'estado-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_tipo_estado'); ?>
        <?php echo $form->dropDownList($model, 'id_tipo_estado', CHtml::listData(TipoEstado::model()->findAll(), 'id_tipo_estado', 'nombre'),array('empty'=>'Ninguno')); ?> 
        <?php echo $form->error($model, 'id_tipo_estado'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar '); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->