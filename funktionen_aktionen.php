<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 25.07.2019
 * Time: 07:31
 */

function hungersnot(){
    echo "<form>";
    require 'mensch.class.php';
    $menschen = unserialize(file_get_contents('menschen.sav'));
    echo "<h1 class='headline2'>eine große Hungersnot überfiel die Welt<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
    if (is_array($menschen) && count($menschen)>0) {
        $opfer = 0;
        $anzahl = count($menschen);
        for ($i=0; $i<$anzahl; $i++) {
            $zufall=rand(0,1);
            if (!$zufall) {
                $opfer++;
                unset($menschen[$i]);   // nicht auf NULL setzen (da bleibt es im Array als Null)
            }
        }
        echo "die Hungersnot hat $opfer Opfer gefordert.";
        $menschen = array_values($menschen);
        file_put_contents('menschen.sav', serialize($menschen));
    }
    else {
        echo "<h2>keine Menschen (mehr) vorhanden</h2>";
    }
    echo "</form>";
}