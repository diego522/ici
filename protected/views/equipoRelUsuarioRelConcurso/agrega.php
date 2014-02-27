<?php
/* @var $this EquipoRelUsuarioRelConcursoController */
/* @var $model EquipoRelUsuarioRelConcurso */
/* @var $form CActiveForm */
?>
<?php if ($autorizado) { ?>
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'equipo-rel-usuario-rel-concurso-agrega-form',
            'enableAjaxValidation' => false,
        ));
        ?>


        <?php echo $form->errorSummary($model); ?>

        <div class="row">

            <?php echo CHtml::activeHiddenField($model, 'id_equipo'); ?>

        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Rut del participante'); ?>
            <?php echo $form->textField($model, 'id_usuario', array('onchange' => "javascript:checkRutField(this.value,'EquipoRelUsuarioRelConcurso_id_usuario')")); ?>
            <?php echo $form->error($model, 'id_usuario'); ?>
        </div>

        <div class="row">

            <?php echo CHtml::activeHiddenField($model, 'id_concurso'); ?>

        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Agregar'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
    <?php
    Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl . '/js/rut.js'
    );
    ?>

<?php } else { ?>
    <div class="form">
        <p class="note"><?php echo $mensaje; ?>
        </p>
    </div>
    <?php
}?>