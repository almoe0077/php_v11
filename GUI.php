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
            <button class="buttons_erstelle" formaction="formular_mensch.php">erstelle Mensch</button>
            <button class="buttons_erstelle" formaction="formular_stadt.php" >erstelle Stadt</button>

            <?php
            require "stadt.class.php";
            require "mensch.class.php";
            /** zuerst vorhandene Arrays aus den *.sav Dateien einlesen */
            $menschen = loadMenschen();
            $staedte = loadStaedte();

            /** wenn ein Mensch erstellt wurde **/
            if (isset($_POST['alter'])) {
                // aktuellen Mensch zum Array hinzufügen und Array speichern
                $menschen[] = $mensch;
                saveMenschen($menschen);
            }

            /** wenn eine Stadt erstellt wurde **/
            if (isset($_POST['einwohner'])) {
                // aktuelle Stadt zum Array hinzufügen und Array speichern
                $staedte[] = $stadt;
                saveStaedte($staedte);
            }
            $cm = ($menschen) ? count($menschen) : 0;
            $cs = ($staedte) ? count($staedte) : 0;
            echo"<p>erstellte Menschen: $cm</p>";
            echo"<p>erstellte Staedte: $cs</p>";
            ?>

            <button class="buttons_zeige"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=menschen">zeige Menschen</a></button>
            <button class="buttons_zeige"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=staedte">zeige Städte</a></button>
        </form>

            <?php
            if (isset($_GET['wert']) && $_GET['wert']=='menschen')
                zeigeMenschen($menschen);
            if (isset($_GET['wert']) && $_GET['wert']=='staedte')
                zeigeStaedte($staedte);


            function loadMenschen() {
                $menschenSerial = file_get_contents('menschen.sav');
                $menschen = unserialize($menschenSerial);
                return $menschen;
            }
            function loadStaedte() {
                $staedteSerial  = file_get_contents('staedte.sav');
                $staedte  = unserialize($staedteSerial);
                return $staedte;
            }
            function saveMenschen($menschen) {
                $menschenSerial = serialize($menschen);
                file_put_contents('menschen.sav', $menschenSerial);
            }
            function saveStaedte($staedte) {
                $staedteSerial = serialize($staedte);
                file_put_contents('staedte.sav', $staedteSerial);
            }
            function zeigeMenschen($menschen) {
                if (is_array($menschen)) {
                    echo "<h1>zeige Menschen</h1>";
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
            }
            function zeigeStaedte($staedte){
                if (is_array($staedte)) {
                    echo "<h1>zeige Städte</h1>";
                    foreach ($staedte as $stadt) {
                        echo "Name:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getName()."'>";
                        echo "Einwohner:<input class='stadtProp' type='text' readonly='true' value='".$stadt->getEinwohner()."'>";
                        echo "Land:<input class='stadtPropR' type='text' readonly='true' value='".$stadt->getLand()."'></br>";
                    }
                }
                else {
                    echo "<h2>keine Städte erstellt</h2>";
                }
            }
            ?>
    </body>
</html>
