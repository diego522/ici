<?php
/* @var $this NoticiaController */
/* @var $dataProvider CActiveDataProvider */
?>


<div class="post-group">

    <!--Barra derecha -->  

    <div class="barraderecha"> 

        <!--Caja 1 --> 
        <h1>SERVICIOS DE LA CARRERA</h1>
        <div class="contenidobarraderecha">
            <ul>
                <li><a href="http://arrau.chillan.ubiobio.cl/sistemaici/adt" target="_new">Sistema de Seguimiento de Actividad de Titulación</a></li>
                <li><a href="http://arrau.chillan.ubiobio.cl/laboratorioICI/" target="_new">Laboratorio de Especialidad</a></li>

            </ul>
        </div>
        <!--End Caja 1 -->  


        <!--Caja 2 --> 
        <h1>SERVICIOS UBB</h1>
        <div class="contenidobarraderecha">
            <ul>
                <li><a href="http://www.ubiobio.cl/intranet" target="_new">Intranet</a></li>
                <li><a href="http://alumnos.ubiobio.cl" target="_new">WebMail</a></li>
                <li><a href="http://www.ueubiobio.cl/adeccaubb/" target="_new">Adecca</a></li>
                <li><a href="http://moodle2.0.ubiobio.cl/" target="_new">Moodle</a></li>
                <li><a href="http://pva.face.ubiobio.cl/moodle/" target="_new">PVA</a></li>
                <li><a href="http://werken.ubiobio.cl/" target="_new">Red de Bibliotecas</a></li>
            </ul>
        </div>
        <h1>OTROS ENLACES</h1>
        <div class="contenidobarraderecha">
            <li><a href="http://www.ubb.cl/" target="_new">Universidad del Bío-Bío</a></li>
            <li><a href="http://www.ubiobio.cl/face/" target="_new">Facultad de Ciencias Empresariales</a></li>
            <li><a href="http://www.ubiobio.cl/dccti/" target="_new">Departamento de Ciencias de la Computación y Técnologías de la Información</a></li>
            <li><a href="http://robotica.chillan.ubiobio.cl/robotica/" target="_new">Grupo de Robótica Chillán</a></li>
            <li><a href="http://robotica.chillan.ubiobio.cl/videojuegos/" target="_new">Grupo de Videojuegos</a></li>
            <li><a href="http://www.innovabiobio.cl/" target="_new">Innova Bío-Bío </a></li>
        </div>
        <!--End Caja 2 --> 

        <!--Caja 3 -->
        <div class="contenidobarraderecha"><img src="" alt="Banner" name="banner" width="300" height="136" id="fotonoticia2"></div>
        <!--End Caja 3 --> 

        <!--Caja 4 -->
        <div class="contenidobarraderecha"><img src="" alt="banner" name="banner" width="300" height="136" id="fotonoticia2"></div>
        <!--End Caja 4 --> 


    </div>
    <!--END Barra derecha -->  
    <!--LISTA DE NOTICIAS NO DESTACADAS-->
    <div id="noticiasIzq" style="width:600px; border:#039; border-bottom:1px dotted #999; display:table; padding-bottom:30px; margin-bottom:40px;">
        <?php
        foreach ($noticias as $not) {
            ?>
            <div style="width:600px; border:#039; border-bottom:1px dotted #999; display:table; padding-bottom:30px; margin-bottom:40px;">
                <i style="color:#B9B9B9;">
                    <?php echo CHtml::encode($not->getAttributeLabel('fecha_actualizacion')); ?>: 
                    <?php echo CHtml::encode($not->fecha_actualizacion); ?>
                </i>
                <h1>
                    <?php echo CHtml::link(CHtml::encode($not->titulo), array('view', 'id' => $not->id_noticia)); ?>
                </h1>
                <?php echo substr(strip_tags($not->contenido), 0, 200) . '...'; ?>
                <br />
                <div class="botonsimple">
                    <?php echo CHtml::link(CHtml::encode("Leer"), array('view', 'id' => $not->id_noticia)); ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div style="text-align:center; font-weight:bold;">
            <?php echo CHtml::link("Ver más Noticias", array('noticia/index',), array('class' => "botonsimple")); ?>
        </div>        

    </div>

    <!--END LISTA DE NOTICIAS NO DESTACADAS-->
</div>



