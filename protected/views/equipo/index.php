<?php
/* @var $this EquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Equipos',
);

?>

<h1>Equipos</h1>
<?php echo CHtml::link('<img align="middle" title="Descarga en PDF" src="' . Yii::app()->request->baseUrl . '/images/pdf_icon.png"/>', array('viewListaDeEquiposPDF')); ?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
