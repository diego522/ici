<?php

class EquipoRelUsuarioRelConcursoController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('agrega', 'renuncia'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAgrega($idc, $ide) {
        $model = new EquipoRelUsuarioRelConcurso;
        $modelConcurso = Concurso::model()->findByPk($idc);
        if ($modelConcurso != NULL) {
            //validacion de fechas para ingresar
            if ($modelConcurso->verificaDisponibilidadDePlazo()) {
                $modelEquipo = Equipo::model()->findByPk($ide);
                if ($modelEquipo != NULL) {
                    $model->id_concurso = $modelConcurso->id_concurso;
                    $model->id_equipo = $modelEquipo->id_equipo;
                    if (isset($_POST['EquipoRelUsuarioRelConcurso'])) {
                        //validaciones
                        $model->attributes = $_POST['EquipoRelUsuarioRelConcurso'];
                        $rut = str_replace('.', '', $model->id_usuario);
                        $arreglo = explode('-', $rut);
                        $rutParticipante = $arreglo[0];
                        $usuario = Usuario::model()->find('username=:us', array(':us' => $rutParticipante));
                        if ($usuario != NULL) {
                            $modelConcursoUsuarioEquipo = EquipoRelUsuarioRelConcurso::model()->find('id_concurso=:idc and id_usuario=:idu', array(':idc' => $modelConcurso->id_concurso, ':idu' => $usuario->id_usuario));
                            if ($modelConcursoUsuarioEquipo == NULL) {
                                $modelConcursoUsuarioEquipoCantidad = EquipoRelUsuarioRelConcurso::model()->findAll('id_concurso=:idc and id_equipo=:ide', array(':idc' => $modelConcurso->id_concurso, ':ide' => $modelEquipo->id_equipo));
                                if (count($modelConcursoUsuarioEquipoCantidad) < $modelConcurso->max_participantes) {
                                    //se puede agregar el participante a este equipo
                                    $model->id_usuario = $usuario->id_usuario;
                                    if ($model->save()) {
                                        // form inputs are valid, do something here
                                        Yii::app()->user->setFlash('success', "Participante agregado correctamente");
                                        $modelConcursoUsuarioEquipo2 = EquipoRelUsuarioRelConcurso::model()->findAll('id_equipo=:ide and id_concurso=:idc', array('ide' => $modelEquipo->id_equipo, 'idc' => $modelConcurso->id_concurso));
                                        foreach ($modelConcursoUsuarioEquipo2 as $participante) {
                                            $usuario = Usuario::model()->findByPk($participante->id_usuario);
                                           $this->SendMail('Nuevo participante', '<h2>Nuevo participante</h2>
                                       Estimad@(s), se ha agregado un nuevo participante a si equipo.<br/>
                                       Su código de equipo es '.$model->id_equipo.', ya puedes agregar tus propuestas en color y, blanco y negro', $usuario->email);
                                       }
                                        $this->redirect(array('equipo/view', 'id' => $model->id_equipo, 'idc' => $model->id_concurso));
                                        return;
                                    }
                                } else {
                                    Yii::app()->user->setFlash('error', "Haz excedido el maximo de participantes disponible");
                                    $this->redirect(array('equipo/view', 'id' => $model->id_equipo, 'idc' => $model->id_concurso));
                                    return;
                                }
                            } else {
                                //el participante ya esta en otro equipo
                                Yii::app()->user->setFlash('error', "El participante tiene otro equipo para este concurso");
                                $this->redirect(array('equipo/view', 'id' => $model->id_equipo, 'idc' => $model->id_concurso));
                                return;
                            }
                        } else {
                            //el participante no existe
                            Yii::app()->user->setFlash('error', "Problema al buscar al participante");
                            $this->redirect(array('equipo/view', 'id' => $model->id_equipo, 'idc' => $model->id_concurso));
                            return;
                        }
                    } else {
                        //correcto
                        $this->renderPartial('agrega', array('model' => $model, 'autorizado' => true), false, true);
                    }
                } else {
                    $this->renderPartial('agrega', array('autorizado' => false, 'mensaje' => 'Equipo no encontrado'), false, true);
                }
            } else {
                $this->renderPartial('agrega', array('autorizado' => false, 'mensaje' => 'Concurso no disponible'), false, true);
            }
        } else {
            $this->renderPartial('agrega', array('autorizado' => false, 'mensaje' => 'Concurso no encontrado'), false, true);
        }
    }

    /* Funcion que renuncia al equipo */

    public function actionRenuncia($idc, $ide) {
        $id_usuario = Yii::app()->user->id;
        $modeloConcurso = Concurso::model()->findByPk($idc);
        $modeloEquipo = Equipo::model()->findByPk($ide);
        $modelUsuario = Usuario::model()->findByPk($id_usuario);
        if ($modeloConcurso != null) {
            if ($modeloEquipo != null) {
                if ($modelUsuario != null) {
                    $modeloConcursoUsuarioEquipo = EquipoRelUsuarioRelConcurso::model()->find('id_usuario=:us and id_concurso=:idc and id_equipo=:ide', array(':us' => $modelUsuario->id_usuario, ':idc' => $modeloConcurso->id_concurso, ':ide' => $modeloEquipo->id_equipo));
                    if ($modeloConcursoUsuarioEquipo != null) {
                        $modeloConcursoUsuarioEquipo->delete();
                        $modeloContador = EquipoRelUsuarioRelConcurso::model()->findAll('id_concurso=:idc and id_equipo=:ide', array(':idc' => $modeloConcurso->id_concurso, ':ide' => $modeloEquipo->id_equipo));
                        if (count($modeloContador) == 0) {
                            //eliminar el equipo
                            $modeloEquipo->delete();
                        }
                        Yii::app()->user->setFlash('success', "Has sido desvinculado del equipo correctamente ");
                        $this->redirect(array('concurso/index'));
                    }
                    //$this->loadModel($id)->delete();
                } else {
                    Yii::app()->user->setFlash('error', "Problema al traer los datos ");
                    throw new CHttpException(404, 'Problema al traer los datos');
                }
            } else {
                Yii::app()->user->setFlash('error', "Problema al traer los datos");
                throw new CHttpException(404, 'Problema al traer los datos');
            }
        } else {
            Yii::app()->user->setFlash('error', "Problema al traer los datos");
            throw new CHttpException(404, 'Problema al traer los datos');
        }
    }

    public function SendMail($asunto, $mensaje, $para) {
        $message = new YiiMailMessage;
        $message->subject = $asunto ? $asunto : 'Asunto';
        $message->setBody($mensaje, 'text/html'); //codificar el html de la vista
        $message->from = (Yii::app()->params['adminEmail']); // alias del q envia
        $message->setTo($para); // a quien se le envia
        //Yii::app()->mail->send($message);
    }

}