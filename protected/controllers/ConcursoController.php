<?php

class ConcursoController extends Controller {

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
                'actions' => array('inicio'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'download'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO,  Rol::$PROFESOR, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO),
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
    public function actionInicio() {
        $this->render('inicio');
    }

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
        $model = new Concurso('create');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Concurso'])) {
            $model->attributes = $_POST['Concurso'];
            // var_dump($_POST['Concurso']);
            //$model->adjunto = 'vacio';
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $model->fechaApertura);
            if ($newDate != null)
                $model->fechaApertura = $newDate->format('Y-m-d H:i:s');
            $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $model->fechaCierre);
            if ($newDate2 != null)
                $model->fechaCierre = $newDate2->format('Y-m-d H:i:s');
            $uploadedFile = CUploadedFile::getInstance($model, 'adjunto');
            $model->adjunto = $uploadedFile;
            if ($model->save()) {
                if ($uploadedFile != NULL) {
                    $fileName = Yii::app()->basePath . Yii::app()->params['ruta_adjunto'] . Yii::app()->params['adjunto_concurso'] . "/" . str_replace(" ", "_", "b_c_" . $model->id_concurso . "_" . "{$uploadedFile}");
                    if ($uploadedFile->saveAs($fileName)) {
                        $adjuntoModel = new Adjunto;
                        $adjuntoModel->ruta = $fileName;
                        $adjuntoModel->tipo = $uploadedFile->getType();
                        $adjuntoModel->nombre = str_replace(" ", "_", "b_c_" . $model->id_concurso . "_" . "{$uploadedFile}");
                        $adjuntoModel->save();
                        $model->adjunto = $adjuntoModel->id_adjunto;
                        $model->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id_concurso));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionDownload($id) {
        $model = $this->loadModel($id);
        $adjuntoModel = Adjunto::model()->findByPk($model->adjunto);
        if ($adjuntoModel != null)
            Yii::app()->request->sendFile($adjuntoModel->nombre, file_get_contents($adjuntoModel->ruta), $adjuntoModel->tipo);
        else
            $this->actionView($id);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Concurso'])) {
            $modelAnterior = $this->loadModel($id);
            $model->attributes = $_POST['Concurso'];
            if ($model->adjunto == NULL)
                $model->adjunto = $modelAnterior->adjunto;
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $model->fechaApertura);
            if ($newDate != null)
                $model->fechaApertura = $newDate->format('Y-m-d H:i:s');
            $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $model->fechaCierre);
            if ($newDate2 != null)
                $model->fechaCierre = $newDate2->format('Y-m-d H:i:s');
            //actualizacion del adjunto
            if ($model->save()) {
                $uploadedFile = CUploadedFile::getInstance($model, 'adjunto');
                if ($uploadedFile != NULL) {
                    $fileName = Yii::app()->basePath . Yii::app()->params['ruta_adjunto'] . Yii::app()->params['adjunto_concurso'] . "/" . str_replace(" ", "_", "b_c_" . $model->id_concurso . "_" . "{$uploadedFile}");
                    if ($uploadedFile->saveAs($fileName)) {
                        $adjuntoModel = new Adjunto;
                        $adjuntoModel->ruta = $fileName;
                        $adjuntoModel->tipo = $uploadedFile->getType();
                        $adjuntoModel->nombre = str_replace(" ", "_", "b_c_" . $model->id_concurso . "_" . "{$uploadedFile}");
                        $adjuntoModel->save();
                        $model->adjunto = $adjuntoModel->id_adjunto;
                        $model->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id_concurso));
            } else {
                Yii::app()->user->setFlash('error', "Problema al guardar los datos  ");
            }
        } else {
            $model->fechaApertura = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fechaApertura));
            $model->fechaCierre = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($model->fechaCierre));
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
        $participaciones = EquipoRelUsuarioRelConcurso::model()->findAll('id_concurso=:ide', array('ide' => $id));
        foreach ($participaciones as $item) {
            $item->delete();
        }
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Concurso');
        $this->render('index',array(
            'dataProvider' => $dataProvider,));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Concurso('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Concurso']))
            $model->attributes = $_GET['Concurso'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Concurso the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Concurso::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La petición no existe');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Concurso $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'concurso-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function gridNombreEstado($data, $row) {
        return Estado::model()->findByPk($data->estado)->nombre;
    }

}
