<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 25.07.2019
 * Time: 07:24
 */

function zeigeStaedte(){
    echo "<form>";
    require 'stadt.class.php';
    $staedte = unserialize(file_get_contents('staedte.sav'));
    if (is_array($staedte) && count($staedte)>0) {
        $counter=1;
        echo "<h1 class='headline2'>zeige Städte<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
        foreach ($staedte as $stadt) {
            echo "<input class='PropNr' type='text' readonly='true' value='$counter'>";
            $wert = 3000000 + $counter;
            echo "<button class='del'><a href=".$_SERVER['PHP_SELF']."?wert=".$wert.">del</a></button>";
            $wert = 1000000 + $wert;
            echo "<button class='chg'><a href=".$_SERVER['PHP_SELF']."?wert=".$wert.">chg</a></button>";
            echo "Name:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getName()."'>";
            echo "Einwohner:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getEinwohner()."'>";
            echo "Land:<input class='stadtPropR' type='text' readonly='true' value='".$stadt->getLand()."'></br>";
            $counter++;
        }
    }
    else {
        echo "<h2>keine Städte (mehr) vorhanden</h2>";
    }
    echo "</form>";
}

function loescheStadt($index) {
    $staedte = unserialize(file_get_contents('staedte.sav'));
    $index -= 3000001;
    unset($staedte[$index]);
    $index++;
    echo "<form><h1 class='headline2'>Stadt Nr. $index gelöscht.<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1></form>";
    $staedte = array_values($staedte);
    file_put_contents('staedte.sav', serialize($staedte));
}

function aendernStadt($index) {
    require 'stadt.class.php';
    $index -= 4000001;
    $staedte = unserialize(file_get_contents('staedte.sav'));
    $name = $staedte[$index]->getName();
    $einwohner = $staedte[$index]->getEinwohner();
    $land = $staedte[$index]->getLand();
    header("Location: formular_stadt.php?name=$name&einwohner=$einwohner&land=$land&index=$index");
}
