<?php

class SolicitudController extends Controller {

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
                'actions' => array('index', 'view', 'Download', 'VerPDF'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR,),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR,),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'resolverSituacion'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = null;
        $periodo = Periodo::obtienePeriodoActual();
        if ($periodo != NULL) {
            $model = new Solicitud;
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Solicitud'])) {
                $model->id_periodo = $periodo->id_periodo;
                $model->attributes = $_POST['Solicitud'];
                $model->fecha_resolucion = NULL;
                if ($model->save()) {
                    if (isset($_POST['rightValues'])) {
                        foreach ($_POST['rightValues'] as $ramo) {
                            $ramoSolicitud = new RamoSolicitud();
                            $ramoSolicitud->id_solicitud = $model->id_solicitud;
                            $ramoSolicitud->id_ramo = $ramo;
                            $ramoSolicitud->save();
                        }
                    }
                    $this->actionUploadFile($model);
                    $this->redirect(array('view', 'id' => $model->id_solicitud));
                }
            }
            $this->render('create', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(500, 'No existe un periodo de solicitudes vigente');
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)) || $model->estado == Estado::$SOLICITUD_PENDIENTE_DE_REVISION) {
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Solicitud'])) {
                $model->attributes = $_POST['Solicitud'];
                if (CUploadedFile::getInstance($model, 'adjunto') == NULL) {
                    $model->adjunto = $this->loadModel($model->id_solicitud)->adjunto;
                }
                if ($model->save()) {
                    foreach ($model->ramoSolicituds as $r) {
                        $r->delete();
                    }
                    if (isset($_POST['rightValues'])) {
                        foreach ($_POST['rightValues'] as $ramo) {
                            $ramoSolicitud = new RamoSolicitud();
                            $ramoSolicitud->id_solicitud = $model->id_solicitud;
                            $ramoSolicitud->id_ramo = $ramo;
                            $ramoSolicitud->save();
                        }
                    }
                    $this->actionUploadFile($model);
                    $this->redirect(array('view', 'id' => $model->id_solicitud));
                }
            }
            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(500, 'La solicitud se encuentra ' . $model->estado0->nombre . ', no puede ser modificada.');
        }
    }

    /**
     * 
     * @param Solicitud $model
     */
    public function actionUploadFile($model) {
        //guardar archivo
        $uploadedFileBN = CUploadedFile::getInstance($model, 'adjunto');
        if ($uploadedFileBN != NULL) {
            if (in_array($uploadedFileBN->extensionName, Adjunto::$formatos_documentos)) {
                $nombre = str_replace(" ", "_", "solicitud_" . $model->id_solicitud . "_" . "{$uploadedFileBN}");
                $rutaCarpeta = Yii::app()->basePath . Yii::app()->params['ruta_solicitudes'] . "/" . $model->id_solicitud;
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
                    $model->adjunto = $adjuntoModel->id_adjunto;
                    $model->save();
                } else {
                    Yii::app()->user->setFlash('error', "Problemas no se pudo guardar el archivo, intente de nuevo.");
                }
            } else {
                Yii::app()->user->setFlash('error', "Solo extensiones " . implode(',', Adjunto::$formatos_documentos) . " son permitidas");
            }
        } else {
            // Yii::app()->user->setFlash('error', "Debe adjuntar un archivo");
        }
    }

    public function actionDownload($id) {
        $model = $this->loadModel($id);
        $adjuntoModel = Adjunto::model()->findByPk($model->adjunto);
        if ($adjuntoModel != null)
            Yii::app()->request->sendFile($adjuntoModel->nombre, file_get_contents($adjuntoModel->ruta), $adjuntoModel->tipo);
        else {
            Yii::app()->user->setFlash('error', "El Archivo no puede ser descargado");
            $this->redirect(array('daemPlanificacion/view', 'id' => $model->id_planificacion));
        }
    }

    public function actionResolverSituacion($id) {
        $model = $this->loadModel($id);
        $model->scenario = "resolver";
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Solicitud'])) {
            $model->attributes = $_POST['Solicitud'];
            if ($model->estado != Estado::$SOLICITUD_PENDIENTE_DE_REVISION)
                $model->fecha_resolucion = Yii::app()->dateFormatter->format("dd/MM/y", strtotime(date('Y-m-d')));
            if ($model->save()) {
                if ($model->estado != Estado::$SOLICITUD_PENDIENTE_DE_REVISION) {
                    $model = $this->loadModel($id);
                    $correo = array();
                    //email para profesor guia
                    $correo[] = $model->idAlumno->email;
                    $correo[] = PeticionesWebService::obtieneCorreoJefe(Yii::app()->user->getState('campus'));
                    $correo[] = PeticionesWebService::obtieneCorreoSecretaria(Yii::app()->user->getState('campus'));
                    $this->SendMail('Resolución de la solicitud', '
                                       Estimado(a) ' . $model->idAlumno->nombre . ', le informamos que su solicitud se encuentra ' . $model->estado0->nombre . ', para mas detalles
                                           ingrese en el sistema de la carrera y podrá revisar las observaciones según sea el caso.', $correo);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->renderPartial('resolverSituacion', array(
            'model' => $model,
                ), false, true);
    }

    public function actionVerPDF($id) {
//traer a los participantes
        $model = $this->loadModel($id);
        if ($model != NULL) {
            $html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->setDefaultFont('helvetica');
            $html2pdf->WriteHTML($this->renderPartial('solicitudPDF', array('model' => $model,), true));
            if ($model->adjunto0 != NULL && strpos($model->adjunto0->tipo, 'pdf') !== FALSE) {
                try {
                    $html2pdf->Output(Yii::app()->basePath . Yii::app()->params['ruta_solicitudes'] . '/temporal_solicitud_' . $model->id_solicitud . '.pdf', 'F');
                    $mpdf = Yii::app()->ePdf->mpdf();
                    $mpdf->SetImportUse();
                    $ow = $mpdf->h;
                    $oh = $mpdf->w;
                    $pw = $mpdf->w / 2;
                    $ph = $mpdf->h;
                    $mpdf->SetDisplayMode('fullpage');
                    $pagecount = $mpdf->SetSourceFile(Yii::app()->basePath . Yii::app()->params['ruta_solicitudes'] . '/temporal_solicitud_' . $model->id_solicitud . '.pdf');
                    for ($i = 0; $i < $pagecount; $i++) {
                        $mpdf->AddPage();
                        $tplidx = $mpdf->importPage($i + 1, '/MediaBox');
                        $mpdf->useTemplate($tplidx, 10, 10, 200);
                    }
                    $pagecount2 = $mpdf->SetSourceFile($model->adjunto0->ruta);
                    for ($i = 0; $i < $pagecount2; $i++) {
                        $mpdf->AddPage();
                        $tplidx = $mpdf->importPage($i + 1, '/MediaBox');
                        var_dump($tplidx);
                        $mpdf->useTemplate($tplidx, 10, 10, 200);
                    }
                    unlink(Yii::app()->basePath . Yii::app()->params['ruta_solicitudes'] . '/temporal_solicitud_' . $model->id_solicitud . '.pdf');
                    $mpdf->Output('solicitud_' . $model->idAlumno->nombre . '.pdf', 'D');
                } catch (Exception $e) {
                    $html2pdf->Output('solicitud_' . $model->idAlumno->nombre . '.pdf', 'D');
                }
            } else {
                $html2pdf->Output('solicitud_' . $model->idAlumno->nombre . '.pdf', 'D');
            }
        } else {
            Yii::app()->user->setFlash('error', "El reporte no puede ser generado");
            $this->actionView($id);
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        if ($this->esPropietario($model)) {
            if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)) || $model->estado == Estado::$SOLICITUD_PENDIENTE_DE_REVISION) {
                $model->delete();
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }else {
                throw new CHttpException(404, 'La solicitud se encuentra ' . $model->estado0->nombre . ', no puede ser eliminada.');
            }
        } else {
            throw new CHttpException(500, 'Ud no está autorizado.');
        }
    }

    /**
     * Lists all models.
     * Mis solicitudes
     */
    public function actionIndex() {
        $model = new Solicitud('search');
        //$model->unsetAttributes();  // clear any default values
        if (isset($_GET['Solicitud']))
            $model->attributes = $_GET['Solicitud'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = NULL;
        $model = new Solicitud('search');
        //$model->unsetAttributes();  // clear any default values
        if (isset($_GET['Solicitud']))
            $model->attributes = $_GET['Solicitud'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Solicitud the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {

        $model = Solicitud::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Solicitud no encontrada.');
        } else {
            if ($this->esPropietario($model)) {
                return $model;
            }
            else
                throw new CHttpException(403, 'Ud. no está autorizado');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Solicitud $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'solicitud-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 
     * @param Solicitud $data
     * @param string $row
     * 
     */
    public function gridEstado($data, $row) {
        return $data->estado0->nombre;
    }

    /**
     * 
     * @param Solicitud $data
     * @param string $row
     * 
     */
    public function gridTipoSolicitud($data, $row) {
        return $data->tipoSolicitud->nombre;
    }

    /**
     * 
     * @param Solicitud $data
     * @param string $row
     * 
     */
    public function gridAlumno($data, $row) {
        return $data->idAlumno->nombre;
    }

    /**
     * 
     * @param Solicitud $data
     * @param string $row
     * 
     */
    public function gridPeriodo($data, $row) {
        return $data->idPeriodo->titulo;
    }

    /**
     * 
     * @param Solicitud $model
     * @return boolean
     */
    private function esPropietario($model) {
        $propietario = FALSE;
        if ($model != null) {
            if ($model->id_alumno == Yii::app()->user->id) {
                $propietario = TRUE;
            }
        }
        return Yii::app()->user->checkeaAccesoMasivo(array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO)) || $propietario;
    }

    public function SendMail($asunto, $mensaje, $para) {
        $message = new YiiMailMessage;
        $message->subject = $asunto ? $asunto : 'Asunto';
        $mensaje.="<br/>--<br/>Atte.<br/> <b>Administrador de sistemas de Ingeniería Civil en Informática UBB<b/><br/>" . Yii::app()->getBaseUrl(true) . " <br/> Éste correo no debe ser respondido.";
        $message->setBody($mensaje, 'text/html'); //codificar el html de la vista
        $message->from = (Yii::app()->params['adminEmail']); // alias del q envia
        $message->setTo($para); // a quien se le envia
        Yii::app()->mail->send($message);
    }

}
