<?php
/* @var $this RequisitosRamoController */
/* @var $model RequisitosRamo */
$this->breadcrumbs = array(
    'Requisitos Ramo'=>array('requisitosRamo/index'),
);
$this->menu = array(
    array('label' => 'Volver', 'url' =>array('requisitosRamo/index')),)
 ;

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
<h1>Detalle del electivo <?php echo $electivos[$model->ramo] ?></h1>
<?php echo CHtml::link('Agregar Prerequisito', array('create', 'idR' => $model->ramo,), array('id' => 'inline')); ?>
<table style="border: rgb(85, 85, 85) solid 1px;">
    <thead>
        <th><b>Electivo Prerequisito</b></th> <th><b>Acción</b></th>
    </thead>
    <?php
    foreach ($electivosConRequisito as $r) {
        foreach ($electivos as $clave => $valor) {
            if ($r == $clave) {
                ?>
                <tr style="border: rgb(85, 85, 85) solid 1px;">
                    <td style="border: rgb(85, 85, 85) solid 1px;"><?php echo $valor; ?></td>
                    <td style="border: rgb(85, 85, 85) solid 1px;"><?php echo CHtml::link('Elimnar', array('eliminar', 'idR' => $model->ramo, 'idRR' => $clave)); ?></td>
                </tr>
                <?php
            }
        }
    }
    ?>
</table>
