<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 15.07.2019
 * Time: 15:33
 */

/** ein Formular mit vier Feldern, die alle einen Wert benötigen

 * dieses Formular wird auf zwei verschiedenen Wegen aufgerufen
 * einmal: wenn es unvollständig ausgefüllt ist (aus check_mensch heraus, welches mit post von hier aufgerufen wird)
 * einmal: wenn wir einen Datensatz ändern wollen (aus GUI-Funktion per header mit get)
 * daraufhin erfolgt dynamischdie Zuweisung des Seitentitels der Überschrift und der Buttonbeschriftung
 * deshalb wird zur Auswertung in der Überschrift und im Namen die Abfrage nach isset($_GET[]) verwendet
 * und sonst über das Array $_REQUEST darauf zugegriffen, darin landet auch das Ergebnis (von post und get)
 * - egal wie übergeben
 * da die Auswertung aber unterschiedlich erfolgen muss, (Unterschied Ändern - Erstellen) gibt es auch ein
 * verstecktes Feld mit dem Inhalt '' für Erstellen bzw. dem Index des zu ändernden Elements
 */

require 'stadt.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    if (isset($_GET['name']))
        echo"<title>Ändere Mensch</title>";
    else
        echo"<title>Erstelle Mensch</title>";
    ?>
    <link rel="stylesheet" href="formular_mensch.css">
</head>
<body>
    <form method="post" action="check_mensch.php">
        <?php
        if (isset($_GET['name']))
            echo "<h2 class=\"headline\">Änderung Mensch</h2>";
        else
            echo "<h2 class=\"headline\">Erstellung Mensch</h2>";
        ?>

        <label for="name">Name:</label>
        <input id="name" name="name" type="text" value="<?php if(isset($_REQUEST['name'])) echo htmlspecialchars($_REQUEST['name']) ?>"><br/>
        <label for="alter">Alter: </label>
        <input id="alter" name="alter" type="number" value="<?php if(isset($_REQUEST['alter'])) echo htmlspecialchars($_REQUEST['alter']) ?>"><br/>
        <label for="wohnort">Wohnort: </label>
        <select id="wohnort" name="wohnort">
            <?php
                $staedte = unserialize(file_get_contents('staedte.sav'));
                foreach ($staedte as $stadt) {
                    if (isset($_REQUEST['wohnort']) && ($_REQUEST['wohnort'] == $stadt->getName()))
                        echo "<option selected>".$stadt->getName()."</option>";
                    else
                        echo "<option>".$stadt->getName()."</option>";
                }
            ?>
        </select>
        <div id="verheiratet">
            verheiratet:
                <input class="verheiratet_inner" type="radio" id="verheiratetJa" name="verheiratet" value="ja" <?php if(isset($_REQUEST['verheiratet']) &&  $_REQUEST['verheiratet']=='ja') echo 'checked="checked"' ?>>
                <label for="verheiratetJa"> ja</label>
                <input type="radio" id="verheiratetNein" name="verheiratet" value="nein" <?php if(isset($_REQUEST['verheiratet']) && $_REQUEST['verheiratet']=='nein') echo 'checked="checked"' ?>>
                <label for="verheiratetNein"> nein</label>
        </div>
        <?php
        if (isset($_GET['name'])) {
            echo "<input id=\"submit\" type=\"submit\" value=\"ändern\">";
            echo "<input id=\"index\" name=\"index\" type=\"text\" hidden value=\"".$_GET['index']."\">";
        }
        else {
            echo "<input id=\"submit\" type=\"submit\" value=\"erstellen\">";
            echo "<input id=\"index\" name=\"index\" type=\"text\" hidden value=\"\">";
            //diese Syntax erzeugt php wenn eine html zeile in eine echo"" anweisung kopiert wird
            //nur Variablen müsssen manuell aus den Anführungszeichen heraus verschoben werden
        }
        ?>
    </form>
    <?php
    if (isset($_POST['fehler']) && (count($_POST['fehler'])>0)) {
        echo '<div class="fehler">';
        foreach ($_POST['fehler'] as $fehler) {
            echo $fehler."</br>";
        }
        echo '</div>';
    }
    ?>
</body>
</html>
