<?php
/* @var $this RolController */
/* @var $model Rol */
/* @var $form CActiveForm */
?>

<h1>Cambio temporal del Rol</h1>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'rol-form',
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'id_rol');?>
        <?php echo $form->dropDownList($model, 'id_rol', CHtml::listData(Rol::model()->findAll('id_rol!='.Rol::$SUPER_USUARIO), 'id_rol', 'nombre'), array('empty' => 'Seleccione')); ?>
        <?php echo $form->error($model, 'id_rol'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Cambiar rol'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
