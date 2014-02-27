<script>
    tinymce.init({
  

        selector: "textarea",
        language: 'es',
   
       // paste_insert_word_content_callback: "convertWord",
// ===========================================
// INCLUDE THE PLUGIN
// ===========================================
        plugins: [
            "advlist autolink lists link image charmap hr print preview anchor",
            "searchreplace wordcount visualblocks code fullscreen",
            "insertdatetime media paste textcolor table jbimages"
        ],
// ===========================================
// PUT PLUGIN'S BUTTON on the toolbar
// ===========================================
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
// ===========================================
// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
// ===========================================
        relative_urls: false});
    function strip_tags(str, allowed_tags)
    {

        var key = '', allowed = false;
        var matches = [];
        var allowed_array = [];
        var allowed_tag = '';
        var i = 0;
        var k = '';
        var html = '';
        var replacer = function(search, replace, str) {
            return str.split(search).join(replace);
        };
        // Build allowes tags associative array
        if (allowed_tags) {
            allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
        }
        str += '';

        // Match tags
        matches = str.match(/(<\/?[\S][^>]*>)/gi);
        // Go through all HTML tags
        for (key in matches) {
            if (isNaN(key)) {
                // IE7 Hack
                continue;
            }

            // Save HTML tag
            html = matches[key].toString();
            // Is tag not in allowed list? Remove from str!
            allowed = false;

            // Go through all allowed tags
            for (k in allowed_array) {            // Init
                allowed_tag = allowed_array[k];
                i = -1;

                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('</' + allowed_tag);
                }

                // Determine
                if (i == 0) {
                    allowed = true;
                    break;
                }
            }
            if (!allowed) {
                str = replacer(html, "", str); // Custom replace. No regexing
            }
        }
        alert(str);
        return str;
    }
</script>
<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/tinymce/tinymce.min.js'
);
?>
<?php
/* @var $this NoticiaController */
/* @var $model Noticia */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'noticia-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => false,
            /* 'clientOptions' => array(
              'validateOnSubmit' => true,) */
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'titulo'); ?>
        <?php echo $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'titulo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contenido'); ?>
        <?php echo $form->textArea($model, 'contenido', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'contenido'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'id_categoria'); ?>
        <?php echo $form->dropDownList($model, 'id_categoria', CHtml::listData(CategoriaNoticia::model()->findAll(), 'id_categoria', 'nombre')); ?> 
        <?php echo $form->error($model, 'id_categoria'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'estado'); ?>
        <?php echo $form->dropDownList($model, 'estado', CHtml::listData(Estado::model()->findAll('id_tipo_estado=' . TipoEstado::$NOTICIA), 'id_estado', 'nombre')); ?> 
        <?php echo $form->error($model, 'estado'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'En Portada'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'prioridad', array(
            '1' => 'No',
            '2' => 'Si',
        ));
        ?> (sólo se muestran las 3 últimas noticias creadas en la portada)
        <?php echo $form->error($model, 'campus'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'imagen_portada'); ?>
        <?php echo $form->fileField($model, 'imagen_portada'); ?>
        <?php echo $form->error($model, 'imagen_portada'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'campus'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'campus', array(
            '0' => 'Todos',
            '1' => 'Concepción',
            '2' => 'Chillán',
        ));
        ?>
        <?php echo $form->error($model, 'campus'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->