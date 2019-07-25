<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 25.07.2019
 * Time: 07:27
 */

function saveFiles() {
    copy('menschen.sav', 'menschen_sav.sav');
    copy('staedte.sav','staedte_sav.sav');
    echo "<script> alert('Staedte und Menschen gespeichert');</script>";
}

function restoreFiles() {
    copy('menschen_sav.sav','menschen.sav');
    copy('staedte_sav.sav','staedte.sav');
    echo "<script> alert('Staedte und Menschen wiederhergestellt');</script>";
}

function countStaedte() {
    $inhaltSerial = file_get_contents('staedte.sav');
    $inhaltTeil = strstr($inhaltSerial, ':');
    $inhaltTeil = substr($inhaltTeil, 1);
    $inhaltTeil = strstr($inhaltTeil, ':', true);
    return $inhaltTeil;
}

function countMenschen() {
    $inhaltSerial = file_get_contents('menschen.sav');
    $inhaltTeil = strstr($inhaltSerial, ':');
    $inhaltTeil = substr($inhaltTeil, 1);
    $inhaltTeil = strstr($inhaltTeil, ':', true);
    return $inhaltTeil;
}

