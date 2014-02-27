<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author w7600
 */
class WebUser extends CWebUser {

    //put your code here
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params = array()) {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }

        $role = $this->getState("rol");
        //echo "rol ".$role." operation ".$operation." resultado de comparar= ".($operation == $role);
        return ($operation == $role);
    }

    public function checkeaAccesoMasivo($operation = array()) {
        foreach ($operation as $operacion) {
            if ($this->checkAccess($operacion, null)) {
                return true;
            }
        }
        return false;
    }

}

?>
