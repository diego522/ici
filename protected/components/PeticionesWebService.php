<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PeticionesWebService {

    /**
     * A traeUsuarioDesdeSI method.
     * @param string username
     * @param string dv
     * @return string respuesta
     */
    public static function traeUsuarioDesdeSI($username, $dv) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->traeUsuarioDesdeSI($username, $dv);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A traeUsuarioDesdeSI method.
     * @param string campus
     * @return mixed datos
     */
    public static function actualizaUsuarioEntodosLosSistemas($id) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $client->actualizaUsuarioEntodosLosSistemas($id);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneParametrosGenerales method.
     * @param string campus
     * @return string[] datos
     */
    public static function obtieneParametrosGenerales($campus) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneParametrosGenerales($campus);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneParametrosGenerales method.
     * @param string campus
     * @return string
     */
    public static function obtieneCorreoSecretaria($campus) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $arreglo = $client->obtieneParametrosGenerales($campus);
            return $arreglo['correo_secretaria'];
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneParametrosGenerales method.
     * @param string campus
     * @return string
     */
    public static function obtieneCorreoJefe($campus) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $arreglo = $client->obtieneParametrosGenerales($campus);
            return $arreglo['correo_jefe_carrera'];
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneParametrosGenerales method.
     * @param string campus
     * @return string
     */
    public static function obtieneNombreJefe($campus) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $arreglo = $client->obtieneParametrosGenerales($campus);
            return $arreglo['nombre_jefe_carrera'];
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneParametrosGenerales method.
     * @param string campus
     * @return string
     */
    public static function obtieneNombreDirectorDep($campus) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $arreglo = $client->obtieneParametrosGenerales($campus);
            return $arreglo['nombre_director_departamento'];
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneTodosLosElectivos method.
     * @param string carrera
     * @param string plan
     * @return mixed electivos
     */
    public static function obtieneTodosLosElectivos($carrera, $plan) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneTodosLosElectivos(utf8_encode($carrera), utf8_encode($plan));
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneElectivoPorCodigo method.
     * @param string codigo
     * @return array electivo
     */
    public static function obtieneElectivoPorCodigo($codigo) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneElectivoPorCodigo($codigo);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneLasAsignaturasCursadasDelAlumno method.
     * @param string rut
     * @param string codigo carrera
     * @return mixed ramos
     */
    public static function obtieneLasAsignaturasCursadasDelAlumno($rut, $codCarrera) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneLasAsignaturasCursadasDelAlumno($rut, $codCarrera);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneLasAsignaturasInscritasDelAlumno method.
     * @param string rut
     * @param string codigo carrera
     * @return mixed ramos
     */
    public static function obtieneLasAsignaturasInscritasDelAlumno($rut, $codCarrera) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneLasAsignaturasInscritasDelAlumno($rut, $codCarrera);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneLasAsignaturasInscritasDelAlumno method.
     * @param string ramo
     * @param string codigo carrera
     * @param string periodo
     * @param string agno
     * @return mixed inscritos
     */
    public static function obtieneAlumnosDeUnRamo($ramo, $codCarrera, $periodo, $agno) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneAlumnosDeUnRamo($ramo, $codCarrera, $periodo, $agno);
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneMallaDeLaCarrera method.
     * @param string codigo carrera
     * @param string plan
     * @return mixed malla
     */
    public static function obtieneMallaDeLaCarrera($codCarrera, $plan) {
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            return $client->obtieneMallaDeLaCarrera(utf8_encode($codCarrera), utf8_encode($plan));
        } catch (Exception $r) {
            return $r;
        }
    }

    /**
     * A obtieneMallaDeLaCarreraPorCampus method.
     * @param string campus
     * @return mixed malla
     */
    public static function obtieneMallaDeLaCarreraPorCampus($campus) {
        $codCarrera = 0;
        $plan = 0;
        if ($campus == '1') {//concepcion
            $codCarrera = "29027";
            $plan = "0,1,2";
        } else {//chillan
            $codCarrera = "29057";
            $plan = "0,1";
        }
        ini_set('soap.wsdl_cache_ttl', 0);
        ini_set('soap.wsdl_cache_enable', 0);
        try {
            $client = new SoapClient(Yii::app()->params['urlWebService']);
            $resutadoEnArray = array();
            $arregloDePlanes = explode(',', $plan);
            foreach ($arregloDePlanes as $p) {
                $cod="29057";
                $plan="1";
                $resutadoEnArray[] = $client->obtieneMallaDeLaCarrera(utf8_encode($cod), utf8_encode($plan));
            }
            return $resutadoEnArray;
        } catch (Exception $r) {
            return $r;
        }
    }

}

?>
