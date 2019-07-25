<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 18.07.2019
 * Time: 15:58
 */

/** diese kleinere Programmbeispiel zeigt verschiedene Varianten bezüglich dem Aufruf anderer Seiten
  * und der Übergabe von Variablen zwischen diesen Seiten - deshalb ist die Struktur nicht einheitlich
  */

require 'funktionen_aktionen.php';
require 'funktionen_helpers.php';
require 'funktionen_menschen.php';
require 'funktionen_staedte.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GUI</title>
        <link rel="stylesheet" href="GUI.css">
    </head>
    <body class="alles">
        <form>
            <h1 class="headline">Unsere Gott-GUI
                <button class='restore'>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=restore">Restore Files</a>
                </button>
                <button class='save'>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wert=save">Save Files</a>
                </button>
            </h1>
            <b>Hinweise:</b></br>
            Städte können nur ein mal erstellt werden (Vergleich erfolgt NUR nach Namen) !</br>
            Soll eine Stadt geändert werden, erfolgt dies auch nur wenn deren neuer Name nooch nicht existiert!</br>
            Menschen können nur innerhalb von (vorher erstellten) Städten erzeugt werden !</br>

            <button class="buttons_erstelle" formaction="formular_mensch.php">erstelle Mensch</button>
            <button class="buttons_erstelle" formaction="formular_stadt.php" >erstelle Stadt</button>

            <?php
            // diese zwei Abfragen muessen hier oben stehen, damit die Counter nach Save bzw. Restore
            // die korrekten Werte anzeigen (sonst sind sie an dieser Stelle nicht aktuell)
            if (isset($_GET['wert']) && $_GET['wert']=='restore')
                restoreFiles();
            if (isset($_GET['wert']) && $_GET['wert']=='save')
                saveFiles();
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
        if (isset($_GET['wert']) && $_GET['wert']>=1000000 && $_GET['wert']<2000000)
            loescheMensch($_GET['wert']);
        if (isset($_GET['wert']) && $_GET['wert']>=2000000 && $_GET['wert']<3000000)
            aendernMensch($_GET['wert']);
        if (isset($_GET['wert']) && $_GET['wert']>=3000000 && $_GET['wert']<4000000)
            loescheStadt($_GET['wert']);
        if (isset($_GET['wert']) && $_GET['wert']>=4000000 && $_GET['wert']<5000000)
            aendernStadt($_GET['wert']);
        ?>
    </body>
</html>
