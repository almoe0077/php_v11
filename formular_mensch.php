<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 15.07.2019
 * Time: 15:33
 */

/** ein Formular mit vier Feldern, die alle einen Wert benötigen */

require 'stadt.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Erstelle Mensch</title>
    <link rel="stylesheet" href="formular_mensch.css">
</head>
<body>
    <form method="post" action="check_mensch.php">
        <h2 class="headline">Erstellung Mensch</h2>
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']) ?>"><br/>
        <label for="alter">Alter: </label>
        <input id="alter" name="alter" type="number" value="<?php if(isset($_POST['alter'])) echo htmlspecialchars($_POST['alter']) ?>"><br/>
        <label for="wohnort">Wohnort: </label>
        <select id="wohnort" name="wohnort">
            <?php
                $staedte = unserialize(file_get_contents('staedte.sav'));
                foreach ($staedte as $stadt) {
                    if (isset($_POST['wohnort']) && ($_POST['wohnort'] == $stadt->getName()))
                        echo "<option selected>".$stadt->getName()."</option>";
                    else
                        echo "<option>".$stadt->getName()."</option>";
                }
            ?>
        </select>

        <!--input id="wohnort" name="wohnort" type="text" value="<?php if(isset($_POST['wohnort'])) echo htmlspecialchars($_POST['wohnort']) ?>"><br/-->
        <div id="verheiratet">
            verheiratet:
                <input class="verheiratet_inner" type="radio" id="verheiratetJa" name="verheiratet" value="ja" <?php if(isset($_POST['verheiratet']) &&  $_POST['verheiratet']=='ja') echo 'checked="checked"' ?>>
                <label for="verheiratetJa"> ja</label>
                <input type="radio" id="verheiratetNein" name="verheiratet" value="nein" <?php if(isset($_POST['verheiratet']) && $_POST['verheiratet']=='nein') echo 'checked="checked"' ?>>
                <label for="verheiratetNein"> nein</label>
        </div>
        <input id="submit" type="submit" value="senden">
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
