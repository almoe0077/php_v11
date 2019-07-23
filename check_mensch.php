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
    if (!isset($_POST["alter"]) || ($_POST["alter"]==""))
        $fehler[] = 'bitte Alter eingeben';
    if (!isset($_POST["wohnort"]) || ($_POST["wohnort"]==""))
        $fehler[] = 'bitte Wohnort eingeben';
    if (!isset($_POST["verheiratet"]) || ($_POST["verheiratet"]==""))
        $fehler[] = 'bitte Ehe-Status ankreuzen';

    if (count($fehler)>0) {
        $_POST['fehler'] = $fehler;
        require "formular_mensch.php";
    }
    else {
        require "mensch.class.php";
        $mensch = new mensch($_POST['name'], $_POST['alter'], $_POST['wohnort'], $_POST['verheiratet']);
        require "GUI.php";
    }

