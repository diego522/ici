<?php
/* @var $this EquipoController */
/* @var $dataProvider CActiveDataProvider */
?>


<page backtop="10mm" backbottom="10mm" backleft="3mm" backright="5mm" orientation="landscape">
    <div align="center">
        <h1>Listado de equipos concurso logo ICI</h1>
        <h4>Generado el: <?php echo date('d/m/Y H:i'); ?> </h4>
    </div>
    <table width="300" border="1" align="center" cellpadding="1">
        <tr>
            <td>
                Código
            </td>
            <td>
                Nombre
            </td>
            <td>
                Estado
            </td>
            <td>
                Fecha participación
            </td>
            <td>
                Prop. B/N
            </td>
            <td>
                Prop. Color
            </td>
        </tr>

        <?php
        $dataProvider->setPagination(false);
        foreach ($dataProvider->getData() as $data) {
            ?>
            <tr>
                <td><?php echo CHtml::encode($data->id_equipo); ?></td>
                <td><?php echo CHtml::encode($data->nombre); ?></td>
                <td><?php echo CHtml::encode($data->estado ? Estados::model()->findByPk($data->estado)->nombre : 'Participante'); ?></td>
                <td><?php echo Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($data->fecha_presentacion)); ?></td>
                <td><?php echo $data->adjunto_bn ? Adjunto::model()->findByPk($data->adjunto_bn)->nombre : 'no hay archivo'; ?></td>
                <td><?php echo $data->adjunto_color ? Adjunto::model()->findByPk($data->adjunto_color)->nombre : 'no hay archivo'; ?></td>
            </tr>
        <?php }
        ?>



    </table>
</page>