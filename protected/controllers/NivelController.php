<?php

class NivelController extends Controller {

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
                'actions' => array('index', 'view','VerPDF'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR, Rol::$PROFESOR,),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR,),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'EditarHorario', 'AnalisisHorario', 'DetalleAnalisisHorario'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR,),
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

    public function actionVerPDF($id) {
//traer a los participantes
        $model = $this->loadModel($id);
        if ($model != NULL) {
            $html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->setDefaultFont('helvetica');
            $html2pdf->WriteHTML($this->renderPartial('horarioPDF', array('model' => $model,), true));
            $html2pdf->Output('horario_' . $model->nombre . '.pdf', 'D');
        } else {
            Yii::app()->user->setFlash('error', "El reporte no puede ser generado");
            $this->actionView($id);
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionEditarHorario($id) {
        $this->layout = null;
        $this->render('editarHorario', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionAnalisisHorario() {
        $horario = new Horario;
        if (isset($_POST['Horario'])) {
            $horario->attributes = $_POST['Horario'];
        }
        $this->render('analisisDeHorario', array('model' => $horario));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionDetalleAnalisisHorario($ramoOriginal, $arrayRamos) {
        $this->renderPartial('detalleAnalisisHorario', array('ramoOriginal' => $ramoOriginal, 'arrayRamos' => $arrayRamos), false, true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Nivel;
        $model->campus = Yii::app()->user->getState('campus');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nivel'])) {
            $model->attributes = $_POST['Nivel'];
            if ($model->save())
                $this->redirect(array('editarHorario', 'id' => $model->id_nivel));
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

        if (isset($_POST['Nivel'])) {
            $model->attributes = $_POST['Nivel'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_nivel));
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
        $condicion = 'campus=' . Yii::app()->user->getState('campus') . ' and estado=' . Estado::$NIVEL_VIGENTE;

        $dataProvider = new CActiveDataProvider('Nivel', array('criteria' => array('condition' => $condicion)));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Nivel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Nivel']))
            $model->attributes = $_GET['Nivel'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Nivel the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Nivel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * 
     * @param Nivel $data
     * @param type $row
     */
    public function gridEstado($data, $row) {
        return $data->estado0->nombre;
    }

    /**
     * Performs the AJAX validation.
     * @param Nivel $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nivel-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
