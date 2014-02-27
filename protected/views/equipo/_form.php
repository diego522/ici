<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'equipo-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre'); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <?php if (Yii::app()->user->checkAccess(Rol::$ADMINISTRADOR) || Yii::app()->user->checkAccess(Rol::$SUPER_USUARIO)) { ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'Lugar'); ?>
            <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado=:idt', array(':idt' => '9')), 'id_estado', 'nombre'),array('empty'=>'Ninguno')); ?>
            <?php echo $form->error($model, 'estado'); ?>
        </div>
    <?php } ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->