<script>
    tinymce.init({selector: 'textarea', language: 'es',
        plugins: "paste textcolor table",
        tools: "inserttable"
    });
</script>
<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/tinymce/tinymce.min.js'
);
?>
<?php
/* @var $this ConcursoController */
/* @var $model Concurso */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'concurso-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="tinymce">
        <?php echo $form->labelEx($model, 'descripcion'); ?><br />
        <?php echo $form->textArea($model, 'descripcion', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
    </div>
    <div class="row">

        <?php echo $form->labelEx($model, 'fechaApertura'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fechaApertura',
            'language' => 'es', //default Yii::app()->language
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fechaApertura'); ?>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'fechaCierre'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fechaCierre',
            'language' => 'es', //default Yii::app()->language
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fechaCierre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'adjunto'); ?><br />
        <?php echo $form->fileField($model, 'adjunto'); ?>
        <?php echo $form->error($model, 'adjunto'); ?>
    </div>

    <?php if (FALSE) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'estado'); ?>
            <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado=:id', array(':id' => 8)), 'id_estado', 'nombre')); ?>
            <?php echo $form->error($model, 'estado'); ?>
        </div>
    <?php } ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->