<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilidades
 *
 * @author w7600
 */
class Utilidades {

    //put your code here

    public static function obtenerTodosLosElectivosPorCampus($idCampus) {
        if ($idCampus == '1') {//concepcion
            $carrera = '29270';
            $plan = "0,1,2";
        } else {
            $carrera = '29570';
            $plan = "0,1";
        }
        $planes = explode(',', $plan);
        $asignaturas = array();
        foreach ($planes as $p) {
            $electivos = PeticionesWebService::obtieneTodosLosElectivos($carrera, $p);
            foreach ($electivos as $e) {
                $asignaturas[$e['codigo']] = $e['agn_nombre'] . " - (" . $e['codigo_visible'] . "- Plan " . $e['plan_carrera'] . ")";
            }
        }
        //extrae los ramos locales
        $ramosLocales = RamoLocal::model()->findAll('campus=:idc', array(':idc' => $idCampus));
        foreach ($ramosLocales as $rl) {
            $asignaturas[$rl['id_ramo']] = $rl['agn_nombre'];
        }
        asort($asignaturas);
        return $asignaturas;
    }

    public static function obtenerTodosLosRamosPorCampus($idCampus) {
        if ($idCampus == '1') {//concepcion
            $carrera = '29270';
            $plan = "0,1,2";
        } else {
            $carrera = '29570';
            $plan = "0,1";
        }
        $planes = explode(',', $plan);
        $asignaturas = array();
        foreach ($planes as $p) {
            $ramos = PeticionesWebService::obtieneMallaDeLaCarrera($carrera, $p);
            foreach ($ramos as $e) {
                $asignaturas[$e['cod_asignatura_real']] = $e['nom_asignatura'] . " (" . $e['cod_asignatura'] . "- Plan " . $e['plan_carrera'] . ")";
            }
        }
        foreach ($planes as $p) {
            $electivos = PeticionesWebService::obtieneTodosLosElectivos($carrera, $p);
            foreach ($electivos as $e) {
                $asignaturas[$e['codigo']] = $e['agn_nombre'] . " - (" . $e['codigo_visible'] . "- Plan " . $e['plan_carrera'] . ")";
            }
        }
        $ramosLocales = RamoLocal::model()->findAll('campus=:idc', array(':idc' => $idCampus));
        foreach ($ramosLocales as $rl) {
            $asignaturas[$rl['id_ramo']] = $rl['agn_nombre'];
        }
        asort($asignaturas);
        return $asignaturas;
    }

    public static function obtenerTodosLosRamosPlanYCarrera($carrera, $plan) {
        $asignaturas = array();

        $ramos = PeticionesWebService::obtieneMallaDeLaCarrera($carrera, $plan);
        foreach ($ramos as $e) {
            $asignaturas[$e['cod_asignatura_real']] = $e['nom_asignatura'] . " (" . $e['cod_asignatura'] . "- Plan " . $e['plan_carrera'] . ")";
        }
        $electivos = PeticionesWebService::obtieneTodosLosElectivos($carrera, $plan);
        foreach ($electivos as $e) {
            $asignaturas[$e['codigo']] = $e['agn_nombre'] . " - (" . $e['codigo_visible'] . "- Plan " . $e['plan_carrera'] . ")";
        }
        asort($asignaturas);
        return $asignaturas;
    }

    public static function obtenerTodosLosInscritosDeUnRamo($idRamo, $idCampus) {
        if ($idCampus == '1') {//concepcion
            $carrera = '29270';
            $plan = "0,1,2";
        } else {
            $carrera = '29570';
            $plan = "0,1";
        }
        $planes = explode(',', $plan);
        $agno = date("Y");
        //$periodo = round($mes / 6) + 1;
        $periodo = ((date("m")) / 6) >= 2 ? 2 : 1;
        $inscritosTotal = array();
        foreach ($planes as $p) {
            $inscritos = PeticionesWebService::obtieneAlumnosDeUnRamo($idRamo, $carrera, $periodo, $agno);
            foreach ($inscritos as $e) {
                $inscritosTotal[$e['rut']] = $e['alu_nombres'] . ' ' . $e['alu_apellido_paterno'] . ' ' . $e['alu_apellido_materno'];
            }
        }

        asort($inscritosTotal);
        return $inscritosTotal;
    }

    public static function obtenerAsignaturasDeUnAlumno($rut, $idCampus) {
        if ($idCampus == '1') {//concepcion
            $carrera = '29270';
        } else {
            $carrera = '29570';
        }
        $asignaturasTotal = array();
        $asignaturas = PeticionesWebService::obtieneLasAsignaturasInscritasDelAlumno($rut, $carrera);
        foreach ($asignaturas as $e) {
            $asignaturasTotal[$e['codigo_base']] = $e['codigo_base'];
        }

        asort($asignaturasTotal);
        return $asignaturasTotal;
    }

}

?>
