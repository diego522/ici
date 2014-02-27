<?php

class NoticiaController extends Controller {

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
                'actions' => array('index', 'view', 'indexPortada'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
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
        $model = new Noticia;
        if ($model->campus == NULL) {
            $model->campus = Yii::app()->user->getState('campus');
        }

        if (isset($_POST['Noticia'])) {
            $model->attributes = $_POST['Noticia'];

            //  $model->estado = 1;
            if ($model->save()) {
                $this->actionUploadFile($model);
                $this->redirect(array('view', 'id' => $model->id_noticia));
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
        // $this->performAjaxValidation($model);
        if (isset($_POST['Noticia'])) {
            $model->attributes = $_POST['Noticia'];
            $model->imagen_portada=$this->loadModel($id)->imagen_portada;
            if ($model->save()){
                $this->actionUploadFile($model);
                $this->redirect(array('view', 'id' => $model->id_noticia));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * 
     * @param Noticia $model
     */
    public function actionUploadFile($model) {
        //guardar archivo
        $uploadedFileBN = CUploadedFile::getInstance($model, 'imagen_portada');
        if ($uploadedFileBN != NULL) {
            if (in_array($uploadedFileBN->extensionName, Adjunto::$formatos_imgagenes)) {
                $nombre = str_replace(" ", "_", "imagen_portada_" . md5($model->id_noticia) . "{$uploadedFileBN}");
                $rutaCarpeta = Yii::app()->basePath . '/../images/' . Yii::app()->params['imagen_noticia'];
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, true);
                }
                $rutaArchivo = $rutaCarpeta . "/" . $nombre;
                if ($uploadedFileBN->saveAs($rutaArchivo)) {
                    
                    $adjuntoModel = new Adjunto;
                    $adjuntoModel->ruta = $rutaArchivo;
                    $adjuntoModel->tipo = $uploadedFileBN->getType();
                    $adjuntoModel->nombre = $nombre;
                    $adjuntoModel->creador = Yii::app()->user->id;
                    $adjuntoModel->save();
                    $model->imagen_portada = $adjuntoModel->id_adjunto;
                    $model->save();
                    $image = Yii::app()->image->load($rutaArchivo);
                    $image->resize(600, 300);
                    $image->save();
                    //$this->redirect('index');
                } else {
                    // $this->redirect('index');
                    Yii::app()->user->setFlash('error', "problemas al guardar el archivo");
                }
            } else {
                //$this->redirect('index');
                Yii::app()->user->setFlash('error', "Solo extensiones " . implode(',', Adjunto::$formatos_acepotados) . " son permitidas");
            }
        }
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
        $condicion = 'estado=' . Estado::$NOTICIA_PUBLICADA . ' and (prioridad=2 or campus=0 ';
        Yii::app()->user->getState('campus') ? $condicion.='or campus=' . Yii::app()->user->getState('campus') : '';
        $condicion.=")";
        $dataProvider = new CActiveDataProvider('Noticia', array('criteria' => array('condition' => $condicion,
                'order' => 'fecha_actualizacion DESC',
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionIndexPortada() {
        $condicion = 'estado=' . Estado::$NOTICIA_PUBLICADA . ' and (prioridad=2 or campus=0 ';
        Yii::app()->user->getState('campus') ? $condicion.='or campus=' . Yii::app()->user->getState('campus') : '';
        $condicion.=") order by fecha_actualizacion DESC limit 0,3";
        
        $noticias=  Noticia::model()->findAll($condicion);
        
        $this->render('indexPortada', array(
            'noticias' => $noticias,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Noticia('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Noticia']))
            $model->attributes = $_GET['Noticia'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Noticia the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Noticia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Noticia $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'noticia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
