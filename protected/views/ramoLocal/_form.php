<?php
/* @var $this RamoLocalController */
/* @var $model RamoLocal */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ramo-local-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con<span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'agn_nombre'); ?>
        <?php echo $form->textField($model, 'agn_nombre', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'agn_nombre'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->