<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Sistema de gestión de ICI',
    'language' => 'es',
    //language for messages and views
    'sourceLanguage' => 'es',
    // preloading 'log' component
    'preload' => array('log'),
    'id' => 'localhost',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'ext.yii-mail.YiiMailMessage',
        'application.extensions.*',
    ),
    'modules' => array(
// uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'proyectodetitulo',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //'ipFilters' => array('127.0.0.1', '::1'),
        //  'ipFilters' => array('*.*.*.*'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
// enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'excel' => array(
            'class' => 'application.extensions.PHPExcel',
        ),
        'session' => array(
           // 'savePath' => '/opt/lampp/htdocs/session_sistemas', // same for all 3 apps
              'savePath' => '/var/www/html/sistemaici/session_sistemas', // same for all 3 apps
            'cookieMode' => 'allow',
            'cookieParams' => array(
                'path' => '/',
            ),
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'encryption' => 'ssl',
                'username' => 'portalactividadtitulacionubb@gmail.com',
                'password' => 'proyectodetitulo',
                'port' => 465,
            /* 'host' => 'smtp.ubiobio.cl',
              'encryption' => 'tls',
              'username' => 'sitiowebici',
              'password' => 'ponLubod.',
              'port' => 587, */
            ),
            'viewPath' => 'application.views.mails',
        ),
	'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver' => 'GD',
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */                ),),),
        'user' => array(
            'class' => 'WebUser',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=sistemaICI_2',
            'emulatePrepare' => true,
            'username' => 'usuarioICI_2',
            'password' => '1jtn8500',
            'charset' => 'utf8',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'defaultRoles' => array('guest'),
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            /* array(
              'class'=>'CWebLogRoute',
              ), */
            ),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '' => 'site/index', // normal URL rules
                array(// your custom URL handler
                    'class' => 'application.components.CustomUrlRule',
                ),
            ),
        ),),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
// this is used in contact page
        'adminEmail' => 'sitiowebici@ubiobio.cl',
        'correoSecretaria' => '', //Conce
        'correoJefeCarrera' => '', //Conce
        'laboratorioCorreo' => 'laboratorioici@ubiobio.cl', //Chillan
        'nombreJefeCarrera1' => '', //conce
        'nombreDirectorDepartamento1' => '', //conce
        'ruta_adjunto' => '/archivos',
        'ruta_solicitudes' => '/archivos/solicitudes',
        'ruta_inscripciones' => '/archivos/inscripciones',
        'imagen_noticia' => '/imagenes_noticia',
        //'ruta_adjunto' => '/archivos',
        'adjunto_concurso' => '/concurso',
        'librarySourcePath' => '/protected/vendors',
        'urlWebService' => 'http://arrau.chillan.ubiobio.cl/sistemaici/webservice/index.php?r=webService/ws',
    ),
);
