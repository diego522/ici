<?php

class PreinscripcionController extends Controller {

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
                'actions' => array('index', 'view', 'misInscripciones', 'renuncia', 'inscribe', 'download'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'ListadoPDF', 'InscribirAlumno', 'Desincribir', 'ListadoExcel', 'AdministrarUnaInscricion'),
                'roles' => array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR,),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
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
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id),
                ), false, true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Preinscripcion;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Preinscripcion'])) {
            $model->attributes = $_POST['Preinscripcion'];
            if ($model->save()) {
                $this->actionUploadFile($model);
                Yii::app()->user->setFlash('success', 'Preinscripcion creada correctamente');
                $this->redirect(array('admin',));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAdministrarUnaInscricion($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Preinscripcion'])) {
            $model->attributes = $_POST['Preinscripcion'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Inscripción creada correctamente');
                $this->redirect(array('admin',));
            }
        }

        $this->render('administrarUnaInscripcion', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionInscribirAlumno($id) {
        if (isset($_POST['rut'])) {
            $rut = str_replace('.', '', $_POST['rut']);
            $arreglo = explode('-', $rut);
            $rut = $arreglo[0];
            $modelU = Usuario::model()->find('username=:us', array('us' => $rut));
            if ($modelU != Null) {
                $modelAlIns = new AlumnoPreinscripcion;
                $modelAlIns->id_preinscripcion = $id;
                $modelAlIns->id_alumno = $modelU->id_usuario;
                $modelCons = AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => $modelAlIns->id_alumno, 'idi' => $modelAlIns->id_preinscripcion));
                if ($modelCons == NULL) {
                    if ($modelAlIns->save()) {
                        Yii::app()->user->setFlash('success', 'Inscripción correcta');
                    } else {
                        Yii::app()->user->setFlash('error', 'No se pude inscribir a este usuario');
                    }
                } else {
                    Yii::app()->user->setFlash('error', 'El alumno ya se encuentra inscrito');
                }
            } else {
                Yii::app()->user->setFlash('error', 'Usuario no encontrado');
            }
        } else {
            Yii::app()->user->setFlash('error', 'Debe ingresar un rut');
        }
        $this->redirect(array('AdministrarUnaInscricion', 'id' => $id));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionDesincribir($idi, $idu) {
        $modelIns = AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => $idu, 'idi' => $idi));
        if ($modelIns != NULL) {
            $modelIns->delete();
            Yii::app()->user->setFlash('success', 'Inscripción eliminada correctamente');
        } else {
            Yii::app()->user->setFlash('error', 'No se puede eliminar la inscripción');
        }
        $this->redirect(array('AdministrarUnaInscricion', 'id' => $idi));
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

        if (isset($_POST['Preinscripcion'])) {
            $model->attributes = $_POST['Preinscripcion'];
            $model->adjunto = $this->loadModel($id)->adjunto;
            if ($model->save()) {
                $this->actionUploadFile($model);
                $this->redirect(array('admin',));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * 
     * @param Preinscripcion $model
     */
    public function actionUploadFile($model) {
        //guardar archivo
        $uploadedFileBN = CUploadedFile::getInstance($model, 'adjunto');
        if ($uploadedFileBN != NULL) {
            if (in_array($uploadedFileBN->extensionName, Adjunto::$formatos_documentos)) {
                $nombre = str_replace(" ", "_", "preinscripcion_" . $model->id_preinscripcion . "_" . "{$uploadedFileBN}");
                $rutaCarpeta = Yii::app()->basePath . Yii::app()->params['ruta_inscripciones'] . "/" . $model->id_preinscripcion;
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
            $this->redirect(array('view', 'id' => $model->id_preinscripcion));
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
        $model = new Preinscripcion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Preinscripcion']))
            $model->attributes = $_GET['Preinscripcion'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionMisInscripciones() {
        $model = new Preinscripcion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Preinscripcion']))
            $model->attributes = $_GET['Preinscripcion'];

        $this->render('misInscripciones', array(
            'model' => $model,
        ));
    }

    /**
     * 
     */
    public function actionInscribe($id) {
        //
        $model = $this->loadModel($id);
        if ($model != Null && $model->estado == Estado::$PREINSCRIPCON_ABIERTA) {
            //verificar si cumple con los requisitos de electivo
            $mallaAlumno = PeticionesWebService::obtieneMallaDeLaCarrera(Yii::app()->user->getState('carrera'), Yii::app()->user->getState('plan'));
            $ramosCursados = PeticionesWebService::obtieneLasAsignaturasCursadasDelAlumno(Yii::app()->db->createCommand("select username from usuario where id_usuario=" . Yii::app()->user->id . ";")->queryScalar(), Yii::app()->user->getState('carrera'));

            //verificar que estado_final_codigo==1 and codigo_base==$cod|| codigo==$cod de la asignatura
            //verificar que tengan aprobafo hasta $periodoMax = 1;  $anioMax = 4; el tema de los créditos
            $periodoMax = 1;
            $anioMax = 4;
            $arrayRamosReqCreditos = array();
            foreach ($mallaAlumno as $row) {
                if ($row['ano_malla'] < $anioMax) {
                    $arrayRamosReqCreditos[] = $row['cod_asignatura'];
                } else {
                    if ($row['ano_malla'] == $anioMax && $row['periodo_malla'] == $periodoMax) {
                        $arrayRamosReqCreditos[] = $row['cod_asignatura'];
                    }
                }
            }
            $arrayRamosCumplidos = array();
            foreach ($ramosCursados as $row) {
                foreach ($arrayRamosReqCreditos as $codRe) {
                    if ($codRe == $row['codigo']) {
                        if ($row['estado_final_codigo'] == "1") {
                            $arrayRamosCumplidos[$codRe] = TRUE;
                        } else {
                            $arrayRamosCumplidos[$codRe] = FALSE;
                        }
                    }
                }
            }
            $requisitosCreditos = TRUE;
            foreach ($arrayRamosCumplidos as $valor) {
                if (!$valor) {
                    $requisitosCreditos = FALSE;
                    break;
                }
            }
            $arrayRequisitosInternos = array();
            $requisitosInternos = RequisitosRamo::model()->findAll('ramo=:idr', array('idr' => $model->ramo));
            foreach ($requisitosInternos as $rI) {
                foreach ($ramosCursados as $rC) {
                    if ($rC['codigo_base'] == $rI->ramo_requisito) {
                        if ($rC['estado_final_codigo'] == "1") {
                            $arrayRequisitosInternos[$rC['codigo_base']] = TRUE;
                        } else {
                            $arrayRequisitosInternos[$rC['codigo_base']] = FALSE;
                        }
                    }
                }
            }
            $requisitoInterno = TRUE;
            foreach ($arrayRequisitosInternos as $valor) {
                if (!$valor) {
                    $requisitoInterno = FALSE;
                    break;
                }
            }
            if ($requisitosCreditos) {
                if ($requisitoInterno) {
                    //inscribe
                    //pendiente la verificacion de los requisitos internos
                    $command = Yii::app()->db->createCommand("CALL inscribe_preinscripcion (:usuario_in,:preinscripcion_in,@out)");
                    $id_u = Yii::app()->user->id;
                    $command->bindParam(":usuario_in", $id_u, PDO::PARAM_INT);
                    $command->bindParam(":preinscripcion_in", $id, PDO::PARAM_INT);
                    $command->execute();
                    $valueOut = Yii::app()->db->createCommand("select @out as result;")->queryScalar();
                    if ($valueOut == '1') {
                        Yii::app()->user->setFlash('success', 'Preinscripción realizada con éxito');
                    } else {
                        Yii::app()->user->setFlash('error', 'La Preinscripción no se puede realizar');
                    }
                } else {
                    Yii::app()->user->setFlash('error', 'Ud. no cumple con los prerequisitos de asignaturas  para poder inscribir este electivo.');
                }
            } else {
                Yii::app()->user->setFlash('error', 'Ud. debe tener aprobado hasta el semestre ' . $periodoMax . ' del año ' . $anioMax . ' de su carrera para poder inscribir este electivo.');
            }
        } else {
            Yii::app()->user->setFlash('error', 'La Preinscripción no se puede realizar por que se encuentra ' . $model->estado0->nombre);
        }
        $this->redirect(array('misInscripciones'));
    }

    /**
     * 
     */
    public function actionRenuncia($id) {
        $model = $this->loadModel($id);
        if ($model != Null && $model->estado == Estado::$PREINSCRIPCON_ABIERTA) {
            //inscribe
            $command = Yii::app()->db->createCommand("CALL renuncia_preinscripcion  (:usuario_in,:preinscripcion_in,@out)");
            $id_u = Yii::app()->user->id;
            $command->bindParam(":usuario_in", $id_u, PDO::PARAM_INT);
            $command->bindParam(":preinscripcion_in", $id, PDO::PARAM_INT);
            $command->execute();
            $valueOut = Yii::app()->db->createCommand("select @out as result;")->queryScalar();
            if ($valueOut == '1') {
                Yii::app()->user->setFlash('success', 'Renuncia realizada con éxito');
            } else {
                Yii::app()->user->setFlash('error', 'La Preinscripción no se puede renunciar ' . $valueOut);
            }
        } else {
            Yii::app()->user->setFlash('error', 'La Preinscripción no se puede renunciar por que se encuentra ' . $model->estado0->nombre);
        }
        $this->redirect(array('misInscripciones'));
    }

    public function actionListadoPDF($id) {
//traer a los participantes
        $model = $this->loadModel($id);
        if ($model != NULL) {
            $html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->setDefaultFont('helvetica');
            $html2pdf->WriteHTML($this->renderPartial('listadoDeInscritos', array('model' => $model,), true));
            $html2pdf->Output('lista_de_inscritos_preinscripcion_' . $model->id_preinscripcion . '.pdf', 'D');
        } else {
            Yii::app()->user->setFlash('error', "El reporte no puede ser generado");
            $this->actionView($id);
        }
    }

    public function actionListadoExcel($id) {
        $model = $this->loadModel($id);
        if ($model != NULL) {
            if ($model->campus == '1') {//concepcion
                $carrera = '29270';
            } else {
                $carrera = '29570';
            }
            $fila = 1;
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'LISTA DE INSCRITOS - INGENIERÍA CIVIL EN INFORMÁTICA - '.$carrera);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':H' . $fila);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet = $objPHPExcel->getActiveSheet();
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');

            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'Generado el ' . date('d/m/Y H:i'));

            $fila++;

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'ASIGNATURA');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $this->gridViewRamo($model->ramo));
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'FECHA DE APERTURA');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $model->fecha_apertura);
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'FECHA DE CIERRE');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $model->fecha_cierre);
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'CUPOS');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $model->cupos);
            $fila++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'INSCRITOS');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, count($model->usuarios));
            $fila++;
            $fila++;

            /* TABLA DE DATOS */
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'NOMBRE');
            $sheet->getStyle('A' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, 'RUT');
            $sheet->getStyle('B' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('B' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, 'EMAIL');
            $sheet->getStyle('C' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('C' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'FECHA INSCRIPCIÓN');
            $sheet->getStyle('D' . $fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('D' . $fila)->getFill()->getStartColor()->setRGB('DDD9D9');

            $fila++;
            foreach ($model->usuarios as $us) {
                if ($us != NULL) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $us->nombre);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $us->username);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $us->email);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => $us->id_usuario, 'idi' => $model->id_preinscripcion))->fecha_realizacion)));

                    $fila++;
                }
            }

            $styleThinBlackBorderOutline = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FF000000'),
                    ),
                ),
            );
            $objPHPExcel->getActiveSheet()->getStyle('A1:L' . ($fila - 1))->applyFromArray($styleThinBlackBorderOutline);

            for ($j = 1; $j <= $fila; $j++) {
                $objPHPExcel->getActiveSheet()->getRowDimension($j)->setRowHeight(18);
            }
            for ($col = 'A'; $col != 'M'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            ob_end_clean();
            ob_start();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="listado_inscritos_' . $this->gridViewRamo($model->ramo) . '_excel.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        } else {
            Yii::app()->user->setFlash('error', "El reporte no puede ser generado");
            $this->actionView($id);
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Preinscripcion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Preinscripcion']))
            $model->attributes = $_GET['Preinscripcion'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Preinscripcion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Preinscripcion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La inscripción no existe.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Inscripcion $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'preinscripcion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 
     * @param Preinscripcion $data
     * @param type $row
     */
    public function gridEstado($data, $row) {
        return $data->estado0->nombre;
    }

    /**
     * 
     */
    public function gridViewRamo($ramo) {
        $ramos = Utilidades::obtenerTodosLosElectivosPorCampus(Yii::app()->user->getState('campus'));
        return $ramos[$ramo];
    }

    /**
     * 
     * @param Preinscripcion $data
     * @param type $row
     * @return string
     */
    public function gridRamo($data, $row) {
        $ramos = Utilidades::obtenerTodosLosElectivosPorCampus(Yii::app()->user->getState('campus'));
        return $ramos[$data->ramo];
    }

    /**
     * 
     * @param Preinscripcion $data
     * @param type $row
     * @return string
     */
    public function gridCupos($data, $row) {
        return $data->cupos;
    }

    /**
     * 
     * @param Preinscripcion $data
     * @param type $row
     * @return string
     */
    public function gridInscritos($data, $row) {
        return count($data->usuarios);
    }

    public function gridFechaInscripcion($data, $row) {
        return Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime(AlumnoPreinscripcion::model()->find('id_alumno=:ida and id_preinscripcion=:idi', array('ida' => Yii::app()->user->id, 'idi' => $data->id_preinscripcion))->fecha_realizacion));
    }

}

