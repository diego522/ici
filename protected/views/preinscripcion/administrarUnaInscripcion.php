<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs = array(
    'Administrador de Preinscripciones' => array('admin'),
    'Administrar',
);
?>
<div align="center">
    <h2>Listado de inscritos</h2>
</div><div class="iconosdescarga">
    <?php echo CHtml::link('<img align="middle" title="Descarga esta vista en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>', array('ListadoPDF', 'id' => $model->id_preinscripcion)); ?>
    <?php echo CHtml::link('<img align="middle" title="Descarga esta vista en Excel" src="' . Yii::app()->request->baseUrl . '/images/xls_icon.png"/>', array('ListadoExcel', 'id' => $model->id_preinscripcion)); ?>
</div>
<table border="0" align="center" >
    <tr>
        <td><b>Ramo:</b></td>
        <td><?php echo $this->gridViewRamo($model->ramo); ?></td>
    </tr>
    <tr>
        <td><b>Estado:</b></td>
        <td><?php echo $model->estado0->nombre; ?></td>
    </tr>
    <tr>
        <td><b>Fecha de Apertura:</b></td>
        <td><?php echo $model->fecha_apertura; ?></td>
    </tr>
    <tr>
        <td><b>Fecha de Cierre:</b></td>
        <td><?php echo $model->fecha_cierre; ?></td>
    </tr>
    <tr>
        <td><b>Cupos:</b></td>
        <td><?php echo $model->cupos; ?></td>
    </tr>
    <tr>
        <td><b>Inscritos:</b></td>
        <td><?php echo count($model->usuarios); ?></td>
    </tr>
</table>

<p></p>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => false,
        /* 'clientOptions'=>array(
          'validateOnSubmit'=>true,
          ), */
        ));
?>
<table>
    <tr>
        <td>Rut:</td><td><input onchange="javascript:checkRutField(this.value, 'rut')" name="rut" id="rut" type="text"></td> <td><?php
            echo CHtml::submitButton('inscribir', array(
                'submit' => array('InscribirAlumno', 'id' => $model->id_preinscripcion),
                    /* 'confirm' => '¿Seguro que desea enviar la propuesta a revisión?, después ya no podrá editarla'
                      // or you can use 'params'=>array('id'=>$id) */
                    )
            );
            ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/js/rut.js'
);
?>

<p></p>
<table border="1" align="center">
    <tr>
        <td><b>NOMBRE</b></td> <td><b>RUT</b></td> <td>EMAIL</td> <td><b>Fecha de Inscripción</b></td> <td>Acción</td>
    </tr>
    <?php
    foreach ($model->usuarios as $us) {
        ?>
        <tr>
            <td><?php echo $us->nombre; ?></td> <td><?php echo $us->username; ?></td> <td><?php echo $us->email; ?></td> <td><?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => $us->id_usuario, 'idi' => $model->id_preinscripcion))->fecha_realizacion)); ?></td><td><?php echo CHtml::link('desincribir', array('desincribir', 'idi' => $model->id_preinscripcion, 'idu' => $us->id_usuario)) ?></td>
        </tr>
        <?php
    }
    ?>
</table>