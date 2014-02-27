<script>
    tinymce.init({selector: 'textarea', language: 'es',
        plugins: "paste textcolor table",
        tools: "inserttable"
    });
</script>
<?php
/* @var $this InscripcionController */
/* @var $model Inscripcion */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/tinymce/tinymce.min.js'
);
?>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'inscripcion-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'actividad'); ?>
        <?php echo $form->textField($model, 'actividad', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'actividad'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fecha_apertura'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fecha_apertura',
            'language' => 'es', //default Yii::app()->language
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fecha_apertura'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'fecha_cierre'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fecha_cierre',
            'language' => 'es', //default Yii::app()->language
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fecha_cierre'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'cupos'); ?>
        <?php echo $form->textField($model, 'cupos'); ?>
        <?php echo $form->error($model, 'cupos'); ?>
    </div>
    <?php if (!$model->isNewRecord) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'estado'); ?>
            <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado=' . TipoEstado::$INSCRIPCION), 'id_estado', 'nombre')); ?> 
            <?php echo $form->error($model, 'estado'); ?>
        </div>
    <?php } ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php echo $form->textArea($model, 'descripcion', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'requisitos'); ?>
        <?php echo $form->textArea($model, 'requisitos', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'requisitos'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'horario'); ?>
        <?php echo $form->textArea($model, 'horario', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'horario'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'adjunto'); ?>
        <?php echo $form->fileField($model, 'adjunto'); ?>
        <?php echo $form->error($model, 'adjunto'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->