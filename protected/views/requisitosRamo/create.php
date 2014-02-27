<?php
/* @var $this RequisitosRamoController */
/* @var $model RequisitosRamo */
/* @var $form CActiveForm */
?>
<h1>Agregar un nuevo Prerequisito</h1>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'requisitos-ramo-create-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'ramo_requisito'); ?>
        <?php echo CHtml::activeDropDownList($model, 'ramo_requisito', Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus')), array('empty' => 'Seleccione')); ?> 
        <?php echo $form->error($model, 'ramo_requisito'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Guardar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->