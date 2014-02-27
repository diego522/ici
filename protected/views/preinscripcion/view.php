<?php
/* @var $this PreinscripcionController */
/* @var $model Preinscripcion */
?>

<h1>Detalle de la Preinscripción </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_inscripcion',
        array('name' => 'ramo', 'value' => $this->gridViewRamo($model->ramo)),
        'fecha_apertura',
        //'fecha_creacion',
        'fecha_cierre',
        array('name' => 'estado', 'value' => $model->estado0->nombre),
        //'creador',
        'cupos',
        array('name' => 'descripcion', 'type' => 'raw'),
        //'campus',
        array('name' => 'docente', 'type' => 'raw'),
        array('name' => 'horario', 'type' => 'raw'),
        array('name' => 'adjunto',
            'type' => 'raw',
            'value' => $model->adjunto ? CHtml::link('Descargar', array('download', 'id' => $model->id_preinscripcion)) : 'No Hay'
        ),
    ),
));
?>

<h2>Asignatura(s) Prerequisito</h2>
<?php
$electivos = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus'));
$requisitosLocales = RequisitosRamo::model()->findAll('ramo=:idr', array('idr' => $model->ramo));
$electivosConRequisito = array();

foreach ($electivos as $clave => $valor) {
    foreach ($requisitosLocales as $r) {
        if ($clave == $r->ramo_requisito) {
            if (!in_array($r->ramo_requisito, $electivosConRequisito))
                $electivosConRequisito[] = $r->ramo_requisito;
        }
    }
}
?>
<table>
    <tr>
        <td><b></b></td>
    </tr>
    <?php
    foreach ($electivosConRequisito as $r) {
        foreach ($electivos as $clave => $valor) {
            if ($r == $clave) {
                ?>
                <tr>
                    <td>- <?php echo $valor; ?></td>
                </tr>
                <?php
            }
        }
    }
    ?>
</table>

