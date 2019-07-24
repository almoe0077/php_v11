<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 18.07.2019
 * Time: 15:58
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GUI</title>
        <link rel="stylesheet" href="GUI.css">
    </head>
    <body class="alles">
        <h1 class="headline">Unsere Gott-GUI</h1>
        <form>
            <b>Hinweise:</b></br>
            Menschen können nur innerhalb von (vorher erstellten) Städten erzeugt werden !</br>
            Städte können nur ein mal erstellt werden !</br>

            <button class="buttons_erstelle" formaction="formular_mensch.php">erstelle Mensch</button>
            <button class="buttons_erstelle" formaction="formular_stadt.php" >erstelle Stadt</button>

            <?php
            $menschenAnzahl = countMenschen();
            $staedteAnzahl  = countStaedte();
            echo"<p>erstellte Menschen: $menschenAnzahl</p>";
            echo"<p>erstellte Staedte: $staedteAnzahl</p>";
            ?>

            <button class="buttons_zeige"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=menschen">zeige Menschen</a></button>
            <button class="buttons_zeige"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=staedte">zeige Städte</a></button></form></br>
            <button class="buttons_zeigeZ2"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=duerre">Hungersnot</a></button>
        </form>

            <?php
            if (isset($_GET['wert']) && $_GET['wert']=='menschen')
                zeigeMenschen();
            if (isset($_GET['wert']) && $_GET['wert']=='staedte')
                zeigeStaedte();
            if (isset($_GET['wert']) && $_GET['wert']=='duerre')
                hungersnot();


            function countMenschen() {
                $inhaltSerial = file_get_contents('menschen.sav');
                $inhaltTeil = strstr($inhaltSerial, ':');
                $inhaltTeil = substr($inhaltTeil, 1);
                $inhaltTeil = strstr($inhaltTeil, ':', true);
                return $inhaltTeil;
            }

            function countStaedte() {
                $inhaltSerial = file_get_contents('staedte.sav');
                $inhaltTeil = strstr($inhaltSerial, ':');
                $inhaltTeil = substr($inhaltTeil, 1);
                $inhaltTeil = strstr($inhaltTeil, ':', true);
                return $inhaltTeil;
            }

            function zeigeMenschen() {
                echo "<form>";
                require 'mensch.class.php';
                $menschen = unserialize(file_get_contents('menschen.sav'));
                echo "<h1 class='headline2'>zeige Menschen<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
                if (is_array($menschen)) {
                    foreach ($menschen as $mensch) {
                        echo "Name:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getName() . "'>";
                        echo "Alter:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getAlter() . "'>";
                        echo "Wohnort:<input class='menschProp' type='text' readonly='true' value='" . $mensch->getWohnort() . "'>";
                        echo "verheiratet:<input class='menschPropR' type='text' readonly='true' value='" . $mensch->getVerheiratet() . "'></br>";
                    }
                }
                else {
                    echo "<h2>keine Menschen erstellt</h2>";
                }
                echo "</form>";
            }
            function zeigeStaedte(){
                echo "<form>";
                require 'stadt.class.php';
                $staedte = unserialize(file_get_contents('staedte.sav'));
                if (is_array($staedte)) {
                    echo "<h1 class='headline2'>zeige Städte<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
                    foreach ($staedte as $stadt) {
                        echo "Name:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getName()."'>";
                        echo "Einwohner:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getEinwohner()."'>";
                        echo "Land:<input class='stadtPropR' type='text' readonly='true' value='".$stadt->getLand()."'></br>";
                    }
                }
                else {
                    echo "<h2>keine Städte erstellt</h2>";
                }
                echo "</form>";
            }
            function hungersnot(){
                echo "<form>";
                require 'mensch.class.php';
                $menschen = unserialize(file_get_contents('menschen.sav'));
                echo "<h1 class='headline2'>eine große Hungersnot überfiel die Welt<button class='x' formaction=".$_SERVER['PHP_SELF'].">X</button></h1>";
                if (is_array($menschen)) {
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
            ?>
    </body>
</html>
