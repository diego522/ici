<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$asignaturas = Utilidades::obtenerTodosLosRamosPorCampus(Yii::app()->user->getState('campus'));
$inscritos = Utilidades::obtenerTodosLosInscritosDeUnRamo($ramoOriginal, Yii::app()->user->getState('campus'));
$arrayDeRamos = explode('-', $arrayRamos);
?>
<h2>
    Asignatura analizada <?php echo $asignaturas[$ramoOriginal]; ?>
</h2>
<?php
foreach ($arrayDeRamos as $rC) {
    ?>
    <h3><?php echo $asignaturas[$rC] ?></h3>
    <table>
        <?php
        $contador=0;
        $inscritosEnElRamoCoicidente = Utilidades::obtenerTodosLosInscritosDeUnRamo($rC, Yii::app()->user->getState('campus'));
        foreach ($inscritosEnElRamoCoicidente as $clave1 => $valor1) {//alumno en ramo coicidente
            
            foreach ($inscritos as $clave2 => $valor2) {
                if ($clave1 == $clave2) {
                    $contador++;
                    echo "<tr><td></td><td>".$valor1." </td></tr>";
                }
            }
        }
        ?>

        <tr>
            <td><b>Total</b></td>
            <td><?php echo $contador;?></td>
        </tr>
    </table>
    <?php
}
?>