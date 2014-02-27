

<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />

        <!--/*SCRIPT DE CARRUSEL*/-->

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.roundabout-1.0.min.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.easing.1.3.js"></script>



        <!--[if IE 6]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/DD_belatedPNG_0.0.8a-min.js"></script>
        <script>
          /* EXAMPLE */
          DD_belatedPNG.fix('.button');
          
          /* string argument can be any CSS selector */
          /* .png_bg example is unnecessary */
          /* change it to what suits you! */
        </script>
        <![endif]--> 
        <!--/*FIN SCRIPT DE CARRUSEL*/-->   

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>
    <body>
        <div id="header"><div id="headercentral">
                <!--<div id="headerlogoubb"></div>-->
                <a href="http://www.acreditaci.cl/index.php?option=com_content&view=article&id=33&Itemid=152" target="_blank" class="acreditada" style="float:right;">  </a>
                <div id="logo">Escuela de <br />
                    Ingeniería Civil Informática</div></div>
        </div><!-- header -->
        <div id="rolheader" style="font-size: 10px;">
            <?php
            if (Yii::app()->user->getState("rol")) {
                echo CHtml::link(Yii::app()->user->getState('nombre'), array('usuario/view', 'id' => Yii::app()->user->id,));
                echo " " . Rol::model()->findByPk(Yii::app()->user->getState("rol"))->nombre . " ";
                echo CHtml::link('Cerrar sesión', array('/site/logout'));

                if (Yii::app()->user->getState('rol_real') != Yii::app()->user->getState('rol')) {
                    echo CHtml::link(' Volver a mi rol', array('rol/volverRolOriginal',));
                }
            }
            ?>
        </div>
        <div id="mainMbMenu" class="barramenu">
            <div class="menujerarquico" >

                <?php
                $this->widget('application.extensions.mbmenu.MbMenu', array(
                    'items' => array(
                        array('label' => 'Inicio', 'url' => array('noticia/indexPortada'), 'visible' => TRUE),
                        array('label' => 'Acerca de', 'items' => array(
                                array('label' => 'Nuestra Carrera', 'url' => array('/site/page', 'view' => 'about')),
                                array('label' => 'Misión y Visión', 'url' => array('/site/page', 'view' => 'mision')),
                                array('label' => 'Noticias y Avisos', 'url' => array('noticia/index'),),
                                array('label' => 'Perfil de Egreso', 'url' => array('/site/page', 'view' => 'perfilEgreso'),),
                                array('label' => 'Articulación con Postgrado', 'url' => array('/site/page', 'view' => 'articulacion'),),
                                array('label' => 'Reglamento', 'url' => array('/site/page', 'view' => 'reglamento'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Programas de Asignatura Chillán', 'url' => array('/site/page', 'view' => 'programas_chillan'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Ubicación Geográfica', 'url' => array('/site/page', 'view' => 'ubicacionGeografica'),),
                                array('label' => 'Concurso Logo', 'url' => array('concurso/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            //array('label' => 'Contacto', 'url' => array('/site/page', 'view' => 'contact'))
                            ), 'visible' => true),
                        array('label' => 'Solicitudes', 'items' => array(
                                array('label' => 'Elevar Solicitud', 'url' => array('solicitud/create'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO)),),
                                array('label' => 'Mis Solicitudes', 'url' => array('solicitud/index'),),
                                array('label' => 'Administrar Solicitudes', 'url' => array('solicitud/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)),),
                                array('label' => 'Periodos Solicitudes', 'url' => array('periodo/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO))),
                        array('label' => 'Inscripciones', 'items' => array(
                                array('label' => 'Inscripciones Disponibles', 'url' => array('inscripcion/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO)),),
                                array('label' => 'Mis Inscripciones', 'url' => array('inscripcion/misInscripciones'),),
                                array('label' => 'Administrar Inscripciones', 'url' => array('inscripcion/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR,)),),
                            //sarray('label' => 'Periodos Solicitudes', 'url' => array('periodo/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO))),
                        array('label' => 'Preinscripciones', 'items' => array(
                                array('label' => 'Preinscripciones Disponibles', 'url' => array('preinscripcion/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR)),),
                                array('label' => 'Mis Preinscripciones', 'url' => array('preinscripcion/misInscripciones'),),
                                array('label' => 'Administrar Preinscripciones', 'url' => array('preinscripcion/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)),),
                                array('label' => 'Administrar Prerrequisitos de electivos', 'url' => array('requisitosRamo/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$ALUMNO))),
                        array('label' => 'Actividad de Titulación', 'url' => 'http://arrau.chillan.ubiobio.cl/sistemaici/adt'),
                        array('label' => 'Horario', 'items' => array(
                                array('label' => 'Horarios Vigentes', 'url' => array('nivel/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)),),
                                array('label' => 'Análisis de horario', 'url' => array('nivel/AnalisisHorario'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)),),
                                array('label' => 'Administrador de horarios', 'url' => array('nivel/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            //array('label' => 'Administrar Preinscripciones', 'url' => array('preinscripcion/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR)),),
                            //sarray('label' => 'Periodos Solicitudes', 'url' => array('periodo/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                        array('label' => 'Administración', 'items' => array(
                                array('label' => 'Administrar Usuarios', 'url' => array('usuario/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Administrar Noticias', 'url' => array('noticia/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                //array('label' => 'Estados', 'url' => array('estado/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO,))),
                                array('label' => 'Cambio de Rol', 'url' => array('rol/cambioRol'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                //array('label' => 'Tipos de estados', 'url' => array('tipoEstado/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO,))),
                                array('label' => 'Parámetros Generales ', 'url' => array('parametrosGenerales/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Administrar Concurso', 'url' => array('concurso/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                        array('label' => 'Iniciar Sesión', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    // array('label' => 'Cerrar Sesión', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div>
        </div><!-- mainmenu -->
        <?php
        $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        if (FALSE !== strpos($url_actual, 'indexPortada')) {
            ?>
            <!--/*SCRIPT DE CARRUSEL*/-->
            <!--	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.roundabout-1.0.min.js"></script> 
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.easing.1.3.js"></script>
            <script type="text/javascript">
                $(document).ready(function() { //Start up our Featured Project Carosuel
                $('#featured ul').roundabout({
                easing: 'easeOutInCirc',
                duration: 600
                });
                });
            </script> 
            <!--[if IE 6]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/DD_belatedPNG_0.0.8a-min.js"></script>
            <script>
              /* EXAMPLE */
              DD_belatedPNG.fix('.button');
              
              /* string argument can be any CSS selector */
              /* .png_bg example is unnecessary */
              /* change it to what suits you! */
            </script>
            <![endif]--> 
            <!--/*FIN SCRIPT DE CARRUSEL*/-->   
            <div id="destaca">
                <!-- Featured Image Slider -->
                <div id="featured" class="clearfix grid_12"  >
                    <ul> 
                        <?php
                        //$condicion = 'estado=' . Estado::$NOTICIA_PUBLICADA . ' and (campus=0 ';
                        $condicion = 'estado=' . Estado::$NOTICIA_PUBLICADA;
                        // Yii::app()->user->getState('campus') ? $condicion.='or campus=' . Yii::app()->user->getState('campus') : '';
                        $condicion.=" and prioridad=2 order by fecha_actualizacion DESC limit 0,3";
                        $noticias = Noticia::model()->findAll($condicion);
                        foreach ($noticias as $n) {
                            echo "<li>";
                            echo CHtml::link("<span>" . $n->titulo . "</span>", array('noticia/view', 'id' => $n->id_noticia));
                            if ($n->imagen_portada != null) {
                                $adjunto = Adjunto::model()->findByPk($n->imagen_portada);
                                if ($adjunto != NULL)
                                    echo '<img src = "' . Yii::app()->request->baseUrl . '/images/' . Yii::app()->params['imagen_noticia'] . '/' . $adjunto->nombre . '" alt = "" width="600px"/>';
                                else
                                    echo '<img src = "' . Yii::app()->request->baseUrl . '/images/' . Yii::app()->params['imagen_noticia'] . '/defecto.png" alt = "" width="600px"/>';
                            }else {
                                echo '<img src = "' . Yii::app()->request->baseUrl . '/images/' . Yii::app()->params['imagen_noticia'] . '/defecto.png" alt = "" width="600px"/>';
                            }
                            echo "</li>";
                        }
                        ?>
                    </ul> 
                </div>
                <!-- END Featured Image Slider -->          
            </div>
        <?php } ?>          
        <!-- contenido -->  
        <div class="container" id="page">          
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
                <!-- breadcrumbs -->
            <?php endif ?>
            <?php
            $flashMessages = Yii::app()->user->getFlashes();
            if ($flashMessages) {
                echo '<ul class="flashes">';
                foreach ($flashMessages as $key => $message) {
                    echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                }
                echo '</ul>';
            }
            ?>
            <?php echo $content; ?>
            <div class="clear"></div>
        </div><!-- END contenido -->
        <!-- PIE -->
        <div id="pie">
            <div class="piecontenedor">
                <div class="piecaja">
                    <p>Escuela de Ingeniería Civil Informática</p>
                    <p>SEDE CONCEPCIÓN<br />
                        Av. Collao 1202</p>
                    <p>SEDE CHILLÁN<br />
                        Av. Andrés Bello s/n
                    </p>
                </div>
                <div class="piecaja">
                    <a href="http://www.acreditaci.cl/index.php?option=com_content&view=article&id=33&Itemid=152" target="_blank" class="acreditada">  </a>
                </div>
                <div class="piecaja"><!--PIE B --><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/redes_soc.png" alt="Redes sociales" width="200" height="122" border="0" usemap="#Map" />
                    <map name="Map" id="Map">
                        <area shape="poly" coords="15,39,79,24,97,93,29,109" href="https://www.facebook.com/iciubb" target="_new" alt="Facebook" />
                    </map>
                </div>
                <div class="piecaja">
                    <div id="headerlogoubb"></div>
                </div>
            </div>
        </div><!-- ENDPIE -->
    </body>
</html>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'google', "
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46798848-1', 'ubiobio.cl');
  ga('send', 'pageview');

", CClientScript::POS_READY
);
?>