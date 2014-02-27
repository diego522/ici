<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Documentos del reglamento</h1>
<?php
$dir =Yii::app()->basePath . "/documentacion/Reglamento"; // Directory where files are stored

if ($dir_list = opendir($dir)) {
    while (($filename = readdir($dir_list)) != false) {?>
        <p><a href="<?php echo $filename; ?>"><?php echo $filename;?></a></p>
        <?php
    }
    closedir($dir_list);
}
?>