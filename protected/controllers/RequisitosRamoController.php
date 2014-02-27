<?php

class RequisitosRamoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('create', 'detalle', 'eliminar','index'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR,),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreate($idR) {
        $model = new RequisitosRamo;
        $model->ramo = $idR;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'requisitos-ramo-create-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['RequisitosRamo'])) {
            $model->attributes = $_POST['RequisitosRamo'];
            $modelVerificacion = RequisitosRamo::model()->findAll('ramo=:id and ramo_requisito=:idr', array(':id' => $model->ramo, ':idr' => $model->ramo_requisito));
            if (count($modelVerificacion) == 0 && $model->save()) {
                Yii::app()->user->setFlash('success', 'Prerequisito agregado correctamente');
                $this->redirect(array('detalle', 'idR' => $model->ramo));
                return;
            } else {
                Yii::app()->user->setFlash('error', 'Prerequisito ya existe');
            }
        }
        $this->renderPartial('create', array('model' => $model), false, true);
    }

    public function actionDetalle($idR) {
        $model = new RequisitosRamo;
        $model->ramo = $idR;
        $this->render('detalle', array('model' => $model));
    }

    public function actionEliminar($idR, $idRR) {
        $modelVerificacion = RequisitosRamo::model()->find('ramo=:id and ramo_requisito=:idr', array(':id' => $idR, ':idr' => $idRR));
        if ($modelVerificacion != NULL) {
            $modelVerificacion->delete();
            Yii::app()->user->setFlash('success', 'Prerequisito eliminado correctamente');
            $this->redirect(array('detalle', 'idR' => $idR));
        }
    }

}