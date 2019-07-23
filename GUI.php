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
            <button class="buttons_was" formaction="formular_mensch.php">erstelle Mensch</button>
            <button class="buttons_was" formaction="formular_stadt.php" >erstelle Stadt</button>
            <?php

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

                echo"<p>erstellte Menschen: ".count($menschen)."</p>";
                echo"<p>erstellte Staedte: ".count($staedte)."</p>";



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
            ?>
        </form>
    </body>
</html>
