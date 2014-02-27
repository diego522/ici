<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'usuario-form',
        'enableClientValidation' => false,
        /*'clientOptions' => array(
            'validateOnSubmit' => true,)*/
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('onchange' => "javascript:checkRutField(this.value,'Usuario_username')", 'size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Importar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/rut.js'
);
?>