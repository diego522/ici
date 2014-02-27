<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $horarioCoincidente Horario */
/* @var $form CActiveForm */
?>

<h1>
    Ánalisis de horarios
</h1>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'horario-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_ramo'); ?>
        <?php echo CHtml::activeDropDownList($model, 'id_ramo', Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus')), array('empty' => 'Seleccione', 'onchange' => 'this.form.submit()')); ?> 
        <?php echo $form->error($model, 'id_ramo'); ?>
    </div> (Solo considera los horarios vigentes)


    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$dias = Dia::model()->findAll();
$bloques = Bloque::model()->findAll();
$asignaturas = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus'));
if ($model->id_ramo != NUll) {
    $inscritos = Utilidades::obtenerTodosLosInscritosDeUnRamo($model->id_ramo, Yii::app()->user->getState('campus'));
      // var_dump($inscritos);
    ?>

    <table style="border: 1px;">
        <thead>
        <th></th>
        <?php foreach ($dias as $dia) { ?>
            <th><?php echo $dia->nombre; ?></th>
        <?php } ?>
    </thead>
    <tbody>
        <?php
        foreach ($bloques as $bloque) {
            ?>
            <tr>
                <td><?php echo $bloque->hora_inicio . " - " . $bloque->hora_fin; ?></td>
                <?php
                foreach ($dias as $dia) {
                    ?>
                    <td>
                        <?php
                        $horarios = Horario::model()->findAll('id_nivel in (select id_nivel from nivel where estado=' . Estado::$NIVEL_VIGENTE . ') and id_ramo=:idr and id_dia=:idd and id_bloque=:idb and campus=:idc', array(':idr' => $model->id_ramo, ':idd' => $dia->id_dia, ':idb' => $bloque->id_bloque, ':idc' => Yii::app()->user->getState('campus')));
                        ?>
                        <table>
                            <?php
                            foreach ($horarios as $horario) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        $contadorDeAlumnosConProblemas=0;
                                        $arrayDeAsignaturasCoicidentes=array();
                                        $horariosQueCoiciden = Horario::model()->findAll('id_nivel in (select id_nivel from nivel where estado=' . Estado::$NIVEL_VIGENTE . ') and id_dia=:idd and id_bloque=:idb and campus=:idc', array(':idd' => $horario->id_dia, ':idb' => $horario->id_bloque, ':idc' => Yii::app()->user->getState('campus')));
                                        foreach ($horariosQueCoiciden as $horarioCoincidente) {
                                            if ($horarioCoincidente->id_ramo != $model->id_ramo){
                                                $arrayDeAsignaturasCoicidentes[]=$horarioCoincidente->id_ramo;
                                                $inscritosEnElRamoCoicidente = Utilidades::obtenerTodosLosInscritosDeUnRamo($horarioCoincidente->id_ramo, Yii::app()->user->getState('campus'));
                                                foreach($inscritosEnElRamoCoicidente as $clave1=>$valor1){//alumno en ramo coicidente
                                                    foreach($inscritos as $clave2=>$valor2){
                                                        if($clave1==$clave2){
                                                            $contadorDeAlumnosConProblemas++;
                                                        }
                                                    }
                                                }
                                                //traer a los alumnos de inscritos en $horarioCoincidente->id_ramo
                                                //echo $asignaturas[$horarioCoincidente->id_ramo];
                                            }
                                        }
                                        if($contadorDeAlumnosConProblemas>0){
                                            echo CHtml::link($contadorDeAlumnosConProblemas,array('DetalleAnalisisHorario','ramoOriginal'=>$model->id_ramo,'arrayRamos'=>  implode('-', $arrayDeAsignaturasCoicidentes)),array('id'=>'inline'));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php ?>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table>
<?php } ?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => false,
    ),
        )
);
?>