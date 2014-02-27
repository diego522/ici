<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs = array(
    'Noticias' => array('index'),
    $model->titulo,
);
?>

<h1><?php echo $model->titulo ?> </h1>
<i style="color:#B9B9B9;">Actualizada el <?php echo $model->fecha_actualizacion ?></i><br/><br/>

<?php
//if ($model->imagen_portada != null) {
//    $adjunto = Adjunto::model()->findByPk($model->imagen_portada);
//    if ($adjunto != NULL)
//        //echo '<img src = "' . Yii::app()->request->baseUrl . '/images/' . Yii::app()->params['imagen_noticia'] . '/' . $adjunto->nombre . '" alt = "" width="600px"/>';
//}else {
//    // echo '<img src = "http://arrau.chillan.ubiobio.cl/clonici/css/img_carrusel/concurso_logo/00.png" alt = "" />';
//}
?>

<p>
    <?php echo $model->contenido ?>
</p>

