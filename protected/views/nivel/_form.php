<?php
/* @var $this NivelController */
/* @var $model Nivel */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'nivel-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>
    <?php if (!$model->isNewRecord) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'estado'); ?>
            <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado=:idt', array(':idt' => TipoEstado::$NIVEL)), 'id_estado', 'nombre'), array('empty' => 'Ninguno')); ?>
            <?php echo $form->error($model, 'estado'); ?>
        </div>
    <?php } ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->