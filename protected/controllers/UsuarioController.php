<?php

class UsuarioController extends Controller {

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
                'actions' => array('view'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$PROFESOR, Rol::$ALUMNO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$PROFESOR, Rol::$ALUMNO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'admin', 'delete', 'importarDesdeUBB'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Usuario;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save()){
                PeticionesWebService::actualizaUsuarioEntodosLosSistemas($model->id_usuario);
                $this->redirect(array('view', 'id' => $model->id_usuario));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save()) {
                PeticionesWebService::actualizaUsuarioEntodosLosSistemas($model->id_usuario);
                $this->redirect(array('view', 'id' => $model->id_usuario));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Usuario');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Usuario('search');
        // $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionImportarDesdeUBB() {
        $model = new Usuario;
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->username != NULL) {
                $rut = str_replace('.', '', $model->username);
                $arreglo = explode('-', $rut);
                $rutParticipante = $arreglo[0];
                ini_set('soap.wsdl_cache_enable', 0);
                ini_set('soap.wsdl_cache_ttl', 0);
                try {
                    $client = new SoapClient(Yii::app()->params['urlWebService']);
                    $client->traeUsuarioDesdeSI($rutParticipante, $arreglo[1]);
                    $usuario = Usuario::model()->find('username=' . $rutParticipante);
                    if ($usuario != NULL) {
                        Yii::app()->user->setFlash('success', "Usuario importado correctamente");
                    }
                } catch (Exception $r) {
                    
                }
            }

            $this->redirect(array('admin',));
        }

        $this->renderPartial('importarDesdeUBB', array(
            'model' => $model,
                ), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Usuario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Usuario::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'La petición no existe.');
        } else {
            if ($this->esPropietario($model)) {
                return $model;
            } else {
                throw new CHttpException(500, 'Ud no está autorizado');
            }
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Usuario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function esPropietario($model) {
        $propietario = FALSE;
        if ($model != null) {
            if ($model->id_usuario == Yii::app()->user->id) {
                $propietario = TRUE;
            }
        }
        return Yii::app()->user->checkeaAccesoMasivo(array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO)) || $propietario;
    }

    public function gridRol($data, $row) {
        return $data->idRol->nombre;
    }

}
