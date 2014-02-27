
<script type="text/css">
    SELECT, INPUT[type="text"] {
    width: 160px;
    box-sizing: border-box;
    }
    SECTION {
    padding: 8px;
    background-color: #f0f0f0;
    overflow: auto;
    }
    SECTION > DIV {
    float: left;
    padding: 4px;
    }
    SECTION > DIV + DIV {
    width: 40px;
    text-align: center;
    }    
</script>

<script>
    tinymce.init({selector: 'textarea', language: 'es',
    plugins: "paste textcolor table",
    tools: "inserttable"
    });
</script>
<?php
Yii::app()->clientScript->registerScript('search', '
    $("#btnLeft").click(function () {
    var selectedItem = $("#rightValues option:selected");
    $("#leftValues").append(selectedItem);
    var listbox = document.getElementById("rightValues");
    for(var count=0; count < listbox.options.length; count++) {
            listbox.options[count].selected = true;
    }
});

$("#btnRight").click(function () {
    var selectedItem = $("#leftValues option:selected");
    $("#rightValues").append(selectedItem);
    var listbox = document.getElementById("rightValues");
    for(var count=0; count < listbox.options.length; count++) {
            listbox.options[count].selected = true;
    }
});

$("#rightValues").change(function () {
    var selectedItem = $("#rightValues option:selected");
    $("#txtRight").val(selectedItem.text());
    
});'
);
?><?php
/* @var $this SolicitudController */
/* @var $model Solicitud */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'solicitud-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'tipo_solicitud'); ?>
        <?php echo $form->dropDownList($model, 'tipo_solicitud', CHtml::listData(TipoSolicitud::model()->findAll(), 'id_tipo', 'nombre'), array('empty' => 'Seleccione')); ?> 
        <?php echo $form->error($model, 'tipo_solicitud'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'motivo'); ?>
        <?php echo $form->textArea($model, 'motivo', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'motivo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'adjunto'); ?>
        <?php echo $form->fileField($model, 'adjunto'); ?>
        <?php echo $form->error($model, 'adjunto'); ?>
    </div>

    <div class="row">
        <label >Asignaturas que solicita inscribir (en orden de prioridad)</label>
        <select id="leftValues" name="leftValues" size="5" multiple>
            <?php
            if (Yii::app()->user->getState("carrera") != NULL && Yii::app()->user->getState("plan") != NULL) {
                $todosLosRamos = Utilidades::obtenerTodosLosRamosPlanYCarrera(Yii::app()->user->getState("carrera"), Yii::app()->user->getState("plan"));
            } else {
                //traer mallas segun campus
                $todosLosRamos = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState("campus"));
            }
            if ($model->isNewRecord) {
                foreach ($todosLosRamos as $clave => $valor) {
                    echo '<option value="' . $clave . '">' . $valor . ' </option>';
                }
            } else {
                foreach ($todosLosRamos as $clave => $valor) {
                    $estaPresente = false;
                    foreach ($model->ramoSolicituds as $ramo) {
                        if ($ramo->id_ramo == $clave) {
                            $estaPresente = true;
                            break;
                        }
                    }
                    if ($estaPresente == FALSE)
                        echo '<option value="' . $clave . '">' . $valor . ' </option>';
                }
            }
            ?>                
        </select>

        <input type="button" id="btnLeft" value="&lt;&lt;" />
        <input type="button" id="btnRight" value="&gt;&gt;" />

        <select id="rightValues" name="rightValues[]" size="5" multiple>
            <?php
            if (!$model->isNewRecord) {
                foreach ($model->ramoSolicituds as $ramo) {
                    foreach ($todosLosRamos as $clave => $valor) {
                        if ($ramo->id_ramo == $clave) {
                            echo '<option value="' . $clave . '" selected>' . $valor . ' </option>';
                        }
                    }
                }
            }
            ?>
        </select>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->