<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Programas de asignatura del PLAN 0</h1>
<?php
$dir = Yii::app()->basePath . "/documentacion/programa_asignatura/Programas_2957-0"; // Directory where files are stored

if ($dir_list = opendir($dir)) {
    while (($filename = readdir($dir_list)) != false) {
        ?>
        <p><a href="<?php echo $filename; ?>"><?php echo $filename; ?></a></p>
        <?php
    }
    closedir($dir_list);
}
?>

<h1>Programas de asignatura del PLAN 1</h1>
<?php
$dir = Yii::app()->basePath . "/documentacion/programa_asignatura/Programas_2957-1"; // Directory where files are stored

if ($dir_list = opendir($dir)) {
    while (($filename = readdir($dir_list)) != false) {
        ?>
        <p><a href="<?php echo $filename; ?>"><?php echo $filename; ?></a></p>
        <?php
    }
    closedir($dir_list);
}
?>