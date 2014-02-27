<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>
<?php if ($autorizado) { ?>
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'equipo-uploadFile-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                /* / 'clientOptions'=>array(
                  'validateOnSubmit'=>true,
                  ), */
        ));
        ?>

        <p class="note">Solo son admitidos archivos en formato PDF</br>
            (los archivos antiguos son sobreescritos)
        </p>
        <?php echo $form->errorSummary($model); ?>


        <div class="row">
            <?php echo $form->labelEx($model, 'adjunto_bn'); ?>
            <?php echo $form->fileField($model, 'adjunto_bn'); ?>
            <?php echo $form->error($model, 'adjunto_bn'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'adjunto_color'); ?>
            <?php echo $form->fileField($model, 'adjunto_color'); ?>
            <?php echo $form->error($model, 'adjunto_color'); ?>
        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Guardar'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
<?php } else { ?>
    <div class="form">
        <p class="note">El concurso no está disponible
        </p>
    </div>
<?php } ?>
