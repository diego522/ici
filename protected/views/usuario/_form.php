<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'usuario-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('onchange' => "javascript:checkRutField(this.value,'Usuario_username')", 'size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 300)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'direccion'); ?>
        <?php echo $form->textField($model, 'direccion', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'direccion'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'telefono'); ?>
        <?php echo $form->textField($model, 'telefono', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'telefono'); ?>
    </div>
    <?php if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'id_rol'); ?>
            <?php echo $form->dropDownList($model, 'id_rol', CHtml::listData(Rol::model()->findAll(), 'id_rol', 'nombre'), array('empty' => 'Seleccione')); ?>
            <?php echo $form->error($model, 'id_rol'); ?>
        </div>
    <?php } ?>

    <?php if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'carrera'); ?>
            <?php echo $form->textField($model, 'carrera'); ?>
            <?php echo $form->error($model, 'carrera'); ?>
        </div>
    <?php } ?>
    <?php if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'plan'); ?>
            <?php echo $form->textField($model, 'plan'); ?>
            <?php echo $form->error($model, 'plan'); ?>
        </div>
    <?php } ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'campus'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'campus', array(
            '' => 'Seleccione',
            '1' => 'Concepción',
            '2' => 'Chillán',
        ));
        ?>
        <?php echo $form->error($model, 'campus'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/rut.js'
);
?>