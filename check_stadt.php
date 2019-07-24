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
    /** eine Stadt wird nur neu erstellt, wenn sie nicht schon vorhanden ist (nur der Name wird verglichen) **/
    require "stadt.class.php";
    $stadt = new stadt($_POST['name'], $_POST['einwohner'], $_POST['land']);
    $staedte = loadStaedte();
    $indikator = false;
    foreach ($staedte as $st) {
        if ($st->getName() == $stadt->getName())
            $indikator = true;
    }
    if (!$indikator)
        $staedte[] = $stadt;
    saveStaedte($staedte);
    header("Location: GUI.php");
}

function loadStaedte() {
    $staedteSerial  = file_get_contents('staedte.sav');
    $staedte  = unserialize($staedteSerial);
        return $staedte;
    }
function saveStaedte($staedte) {
    $staedteSerial = serialize($staedte);
    file_put_contents('staedte.sav', $staedteSerial);
}


