<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 25.07.2019
 * Time: 07:21
 */

function zeigeMenschen() {
    echo "<form>";
    require 'mensch.class.php';
    $menschen = unserialize(file_get_contents('menschen.sav'));
    echo "<h1 class='headline2'>zeige Menschen<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
    if (is_array($menschen) && count($menschen)>0) {
        $counter=1;
        foreach ($menschen as $mensch) {
            echo "<input class='PropNr' type='text' readonly='true' value='$counter'>";
            $wert = 1000000 + $counter;
            echo "<button class='del'><a href=".$_SERVER['PHP_SELF']."?wert=".$wert.">del</a></button>";
            $wert = 1000000 + $wert;
            echo "<button class='chg'><a href=".$_SERVER['PHP_SELF']."?wert=".$wert.">chg</a></button>";
            echo "Name:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getName() . "'>";
            echo "Alter:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getAlter() . "'>";
            echo "Wohnort:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getWohnort() . "'>";
            echo "verheiratet:<input class='menschPropR' type='text' readonly='true' value='" . $mensch->getVerheiratet() . "'></br>";
            $counter++;
        }
    }
    else {
        echo "<h2>keine Menschen (mehr) vorhanden</h2>";
    }
    echo "</form>";
}

function loescheMensch($index) {
    $menschen = unserialize(file_get_contents('menschen.sav'));
    $index -= 1000001;
    unset($menschen[$index]);
    $index++;
    echo "<form><h1 class='headline2'>Mensch Nr. $index gelöscht.<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1></form>";
    //echo"<pre>";
    //Array neu indizieren - AN DIESER STELLE ZWINGEND NOTWENDIG !!!
    $menschen = array_values($menschen);
    //var_dump($menschen);
    //echo"</pre>";
    file_put_contents('menschen.sav', serialize($menschen));
}

function aendernMensch($index) {
    require 'mensch.class.php';
    $index -= 2000001;
    $menschen = unserialize(file_get_contents('menschen.sav'));
    $name = $menschen[$index]->getName();
    $alter = $menschen[$index]->getAlter();
    $wohnort = $menschen[$index]->getWohnort();
    $verheiratet = $menschen[$index]->getVerheiratet();
    header("Location: formular_mensch.php?name=$name&alter=$alter&wohnort=$wohnort&verheiratet=$verheiratet&index=$index");
}