<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id;

    public function authenticate() {

        $rut = str_replace('.', '', $this->username);
        $arreglo = explode('-', $rut);
        $this->username = $arreglo[0];
        $hash = sha1($this->password, 1);
        $this->password = base64_encode($hash);

        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        try {
//            $client = new SoapClient(Yii::app()->params['urlWebService']);
//             $client->traeUsuarioDesdeSI($this->username, $arreglo[1]);
//            //echo $client->prueba();
        } catch (Exception $r) {
            //echo $r;
        }
        $usuarioLocal = Usuario::model()->find('username=:us', array(':us' => $this->username));
        //var_dump($usuarioLocal);
        if (!isset($usuarioLocal)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($usuarioLocal->password !== $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $usuarioLocal->id_usuario;
            //verificar rol
            $this->setState('campus', $usuarioLocal->campus);
            $this->setState('carrera', $usuarioLocal->carrera);
            $this->setState('plan', $usuarioLocal->plan);
            $this->setState('nombre', $usuarioLocal->nombre);
            $this->setState('rol', $usuarioLocal->id_rol);
            $this->setState('rol_real', $usuarioLocal->id_rol);
            //cargar opciones del campus
            
         
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}