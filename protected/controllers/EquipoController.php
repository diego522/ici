<?php

class EquipoController extends Controller {

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
                'actions' => array('view', 'uploadFile', 'download'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'viewEquipo', 'viewEquipoPDF', 'viewListaDeEquiposPDF'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'update'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionUploadFile($idc, $ide, $prop) {
        $modelConcurso = Concurso::model()->findByPk($idc);
        $model = Equipo::model()->findByPk($ide);
        if ($model != null && $modelConcurso != null) {
            //validacion de fechas para ingresar
            if ($modelConcurso->verificaDisponibilidadDePlazo()) {
                //esta dentro de los plazos
                if (isset($_POST['Equipo'])) {
                    //model auxiliar
                    $modelEquipoAux = new Equipo;
                    $modelEquipoAux->attributes = $_POST['Equipo'];
                    //guardar archivo
                    $uploadedFileBN = CUploadedFile::getInstance($modelEquipoAux, 'adjunto_bn');
                    if ($uploadedFileBN != NULL) {
                        if ($uploadedFileBN->extensionName == 'pdf') {
                            $nombre = str_replace(" ", "_", "prop_BN_equipo_" . $model->id_equipo . "_" . "{$uploadedFileBN}");
                            $rutaCarpeta = Yii::app()->basePath . Yii::app()->params['ruta_adjunto'] . Yii::app()->params['adjunto_concurso'] . Yii::app()->params['adjunto_propuestas'] . '/';
                            if (!is_dir($rutaCarpeta)) {
                                mkdir($rutaCarpeta);
                            }
                            $fileName = $rutaCarpeta . $nombre;
                            if ($uploadedFileBN->saveAs($fileName)) {
                                $adjuntoModel = new Adjunto;
                                $adjuntoModel->ruta = $fileName;
                                $adjuntoModel->tipo = $uploadedFileBN->getType();
                                $adjuntoModel->nombre = $nombre;
                                $adjuntoModel->save();
                                $model->adjunto_bn = $adjuntoModel->id_adjunto;
                                $model->save();
                                Yii::app()->user->setFlash('success', "La propuesta en blanco y negro se ha actualizado correctamente");
                                //enviar correo electronico por participante
                                $modelConcursoUsuarioEquipo = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide and id_concurso=:idc', array('ide' => $model->id_equipo, 'idc' => $modelConcurso->id_concurso));
                                foreach ($modelConcursoUsuarioEquipo as $participante) {
                                    $usuario = Usuario::model()->findByPk($participante->id_usuario);
                                    $this->SendMail('Actualización de propuesta ByN', '<h2>Actualizacion de propuesta en blanco y negro</h2>
                                       Se ha actualizado correctamente la propuesta.', $usuario->email);
                                }
                            } else {
                                Yii::app()->user->setFlash('error', "problemas al guardar el archivo");
                            }
                        } else {
                            Yii::app()->user->setFlash('error', "Solo extensiones PDF permitido");
                        }
                    }
                    $uploadedFileColor = CUploadedFile::getInstance($modelEquipoAux, 'adjunto_color');
                    if ($uploadedFileColor != NULL) {
                        if ($uploadedFileColor->extensionName == 'pdf') {
                            $nombre = str_replace(" ", "_", "prop_COLOR_equipo_" . $model->id_equipo . "_" . "{$uploadedFileColor}");
                            $fileName = Yii::app()->basePath . Yii::app()->params['ruta_adjunto'] . Yii::app()->params['adjunto_concurso'] . Yii::app()->params['adjunto_propuestas'] . "/" . $nombre;
                            if ($uploadedFileColor->saveAs($fileName)) {
                                $adjuntoModel = new Adjunto;
                                $adjuntoModel->ruta = $fileName;
                                $adjuntoModel->tipo = $uploadedFileColor->getType();
                                $adjuntoModel->nombre = $nombre;
                                $adjuntoModel->save();
                                $model->adjunto_color = $adjuntoModel->id_adjunto;
                                $model->save();
                                Yii::app()->user->setFlash('success', "La propuesta en color se ha actualizado correctamente");
                                $modelConcursoUsuarioEquipo = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide and id_concurso=:idc', array('ide' => $model->id_equipo, 'idc' => $modelConcurso->id_concurso));
                                foreach ($modelConcursoUsuarioEquipo as $participante) {
                                    $usuario = Usuario::model()->findByPk($participante->id_usuario);
                                    $this->SendMail('Actualización de propuesta en Color', '<h2>Actualizacion de propuesta en colores</h2>
                                       Se ha actualizado correctamente la propuesta.', $usuario->email);
                                }
                            }
                        } else {
                            Yii::app()->user->setFlash('error', "Problemas al guardar el archivo");
                        }
                    }

                    $this->redirect(array('equipo/view', 'id' => $model->id_equipo, 'idc' => $idc));
                    return;
                }
                else
                    $this->renderPartial('uploadFile', array('model' => $model, 'autorizado' => true), false, true);
            } else {
                //no esta disponible
                $this->renderPartial('uploadFile', array('autorizado' => false), false, true);
            }
        } else {
            throw new CHttpException(404, 'Problema al traer los datos');
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $idc) {
        //traer a los participantes
        $equipo = $this->loadModel($id);
        $concurso = Concurso::model()->findByPk($idc);
        if ($concurso != NULL) {
            $participantesModel = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide and id_concurso=:idc', array(':ide' => $equipo->id_equipo, ':idc' => $concurso->id_concurso));
            $arrayParticipantes = "";
            $arrayParticipantes .="<ul>";
            $owner = false;
            $id_usuario = Yii::app()->user->id;
            foreach ($participantesModel as $item) {
                if ($id_usuario == $item->id_usuario) {
                    $owner = true;
                }
                $arrayParticipantes.="<li>" . Usuario::model()->findByPk($item->id_usuario)->nombre . "</li>";
            }
            $arrayParticipantes.="</ul>";
            if ($owner) {
                $this->render('view', array('model' => $this->loadModel($id), 'idc' => $idc, 'lista' => $arrayParticipantes));
            } else {
                //Yii::app()->user->setFlash('error', "No esta autorizado a ver estos datos");
                throw new CHttpException(404, 'No esta autorizado a ver estos datos');
            }
        } else {
            //Yii::app()->user->setFlash('error', "Problema al traer los datos");
            throw new CHttpException(404, 'Problema al traer los datos');
        }
    }

    public function actionViewEquipo($id) {
        //traer a los participantes
        $equipo = $this->loadModel($id);
        if ($equipo != NULL) {
            $participantesModel = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide', array(':ide' => $equipo->id_equipo,));
            $arrayParticipantes = $this->tablaParticipantes($participantesModel);
            $this->render('viewEquipo', array('model' => $this->loadModel($id), 'lista' => $arrayParticipantes));
        } else {
            Yii::app()->user->setFlash('error', "Problema al traer los datos");
            throw new CHttpException(404, 'Problema al traer los datos');
        }
    }

    public function actionViewEquipoPDF($id) {
        //traer a los participantes
        $equipo = $this->loadModel($id);
        if ($equipo != NULL) {
            $participantesModel = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide', array(':ide' => $equipo->id_equipo,));
            $arrayParticipantes = $this->tablaParticipantes($participantesModel);
            $html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->setDefaultFont('helvetica');
            $html2pdf->WriteHTML($this->renderPartial('viewEquipoPDF', array('model' => $this->loadModel($id), 'lista' => $arrayParticipantes), true));
            $html2pdf->Output('equipo_' . $equipo->id_equipo . '.pdf', 'D');
        } else {
            Yii::app()->user->setFlash('error', "Problema al traer los datos");
            throw new CHttpException(404, 'Problema al traer los datos');
        }
    }

    public function actionViewListaDeEquiposPDF() {
        //traer a los participantes
        $dataProvider = new CActiveDataProvider('Equipo');
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->setDefaultFont('helvetica');
        $html2pdf->WriteHTML($this->renderPartial('indexPDF', array('dataProvider' => $dataProvider,), true));
        // $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/mainPDF.css');
        // $html2pdf->WriteHTML($stylesheet, 1);
        $html2pdf->Output('listado_equipos.pdf', 'D');
    }

    public function actionDownload($id) {
        $adjuntoModel = Adjunto::model()->findByPk($id);
        if ($adjuntoModel != null)
            Yii::app()->request->sendFile($adjuntoModel->nombre, file_get_contents($adjuntoModel->ruta), $adjuntoModel->tipo);
        else
            $this->actionView($id);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     */
    public function actionCreate($id) {
        $model = new Equipo('create');
        $id_usuario = Yii::app()->user->id;
        if (!empty($id_usuario)) {
            $usuario = Usuario::model()->findByPk($id_usuario);
            if ($usuario != NULL) {
                $concurso = Concurso::model()->findByPk($id);
                if ($concurso != NULL) {
                    if ($concurso->verificaDisponibilidadDePlazo()&&$concurso->estado==Estado::$CONCURSO_ABIERTO) {
                        $modelConcursoEquipoParticipante = EquipoRelUsuarioRelConcurso::model()->find('id_usuario=:idu and id_concurso=:idc', array(':idu' => $usuario->id_usuario, ':idc' => $concurso->id_concurso));
                        if ($modelConcursoEquipoParticipante != NULL) {
                            // ya tiene participacion
                            $this->redirect(array('view', 'id' => $modelConcursoEquipoParticipante->id_equipo, 'idc' => $modelConcursoEquipoParticipante->id_concurso));
                            return;
                        } else {
                            if (isset($_POST['Equipo'])) {
                                $model = new Equipo;
                                $model->attributes = $_POST['Equipo'];
                                //validar que el usuario no tenga equipo
                                if ($model->save()) {
                                    $modelUCE = new EquipoRelUsuarioRelConcurso;
                                    $modelUCE->id_concurso = $concurso->id_concurso;
                                    $modelUCE->id_equipo = $model->id_equipo;
                                    $modelUCE->id_usuario = $usuario->id_usuario;
                                    if ($modelUCE->save()) {
                                        $modelConcursoUsuarioEquipo = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide and id_concurso=:idc', array('ide' => $modelUCE->id_equipo, 'idc' => $modelUCE->id_concurso));
                                        foreach ($modelConcursoUsuarioEquipo as $participante) {
                                            $usuario = Usuario::model()->findByPk($participante->id_usuario);
                                            $this->SendMail('Creación de equipo', '<h2>Creación de equipo</h2>
                                       Estimad@, se ha creado correctamente el equipo participante en el concurso.<br/>
                                       Su código de equipo es ' . $model->id_equipo . ', ya puedes agregar a mas participantes y tus propuestas en color y, blanco y negro', $usuario->email);
                                        }
                                        $this->redirect(array('view', 'id' => $modelUCE->id_equipo, 'idc' => $modelUCE->id_concurso));
                                        return;
                                    } else {
                                        Yii::app()->user->setFlash('error', "Problema al guardar los datos");
                                    }
                                } else {
                                    Yii::app()->user->setFlash('error', "Problema al guardar los datos");
                                }
                            }
                        }
                    } else {
                        throw new CHttpException(500, 'El concurso no está disponible');
                    }
                } else {
                    throw new CHttpException(500, 'Concurso no válido');
                }
            } else {
                throw new CHttpException(500, 'Problemas al traer al usuario de sesión.');
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

        if (isset($_POST['Equipo'])) {
            var_dump($_POST['Equipo']);
            $model->attributes = $_POST['Equipo'];
            if ($model->save()) {
                $this->redirect(array('viewEquipo', 'id' => $model->id_equipo));
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
        $participaciones = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide', array('ide' => $id));
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
    public function actionIndex($idc) {
        $dataProvider = new CActiveDataProvider('Equipo');
        $this->render('index', array(
            'dataProvider' => $dataProvider, 'idc' => $idc,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Equipo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Equipo']))
            $model->attributes = $_GET['Equipo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Equipo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Equipo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Equipo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'equipo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function tablaParticipantes($participantesModel) {
        $arrayParticipantes = "";
        $arrayParticipantes .='<table border="1"><tr><td>Rut</td><td>Nombre</td><td>Email</td></tr>';
        foreach ($participantesModel as $item) {
            $usu = Usuario::model()->findByPk($item->id_usuario);
            $arrayParticipantes.="<tr><td>" . $usu->username . "</td><td> " . $usu->nombre . "</td><td>" . $usu->email . "</td></tr>";
        }
        $arrayParticipantes.="</table>";
        return $arrayParticipantes;
    }

    public function SendMail($asunto, $mensaje, $para) {
        $message = new YiiMailMessage;

        $message->subject = $asunto ? $asunto : 'Asunto';
        $message->setBody($mensaje, 'text/html'); //codificar el html de la vista
        $message->from = (Yii::app()->params['adminEmail']); // alias del q envia
        $message->setTo($para); // a quien se le envia
        Yii::app()->mail->send($message);
    }

}
