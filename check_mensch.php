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
        // die obere Zeile macht, dass die Variable auch in der GUI verfügbar ist, springt ABER NICHT dort hin
        // erst die header-Anweisung springt in die andere Datei zurück
        // deshalb sollte die Speicherung hier erfolgen und dann kann mit header() zurückgesprungen werden
        // alternativ verpasst man der ganzen Nummer hier einen speichern-Button, zum speichern und zurück springen
        require "GUI.php";
        header("Location: GUI.php");
    }

