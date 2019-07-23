<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 16.07.2019
 * Time: 15:53
 */

    $fehler = array();
    if (!isset($_POST["name"]) || ($_POST["name"]==""))
        $fehler[] = 'bitte Namen eingeben';
    if (!isset($_POST["einwohner"]) || ($_POST["einwohner"]==""))
        $fehler[] = 'bitte Einwohnerzahl eingeben';
    if (!isset($_POST["land"]) || ($_POST["land"]==""))
        $fehler[] = 'bitte Land eingeben';

    if (count($fehler)>0) {
        $_POST['fehler'] = $fehler;
        require "formular_stadt.php";
    }
    else {
        require "stadt.class.php";
        $stadt = new stadt($_POST['name'], $_POST['einwohner'], $_POST['land']);
        require "GUI.php";
    }

