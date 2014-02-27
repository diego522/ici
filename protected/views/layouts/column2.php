<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">

        <?php
        if (Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR, Rol::$PROFESOR))) {
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => 'Opciones',
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            $this->endWidget();
        }
        ?>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>