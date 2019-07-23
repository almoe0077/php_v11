<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 15.07.2019
 * Time: 15:33
 */

/** ein Formular mit vier Feldern, die alle einen Wert benötigen */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Erstelle Stadt</title>
    <link rel="stylesheet" href="formular_stadt.css">
</head>
<body>
    <form method="post" action="check_stadt.php">
        <h2 class="headline">Erstellung Stadt</h2>
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']) ?>"><br/>
        <label for="einwohner">Einwohner:</label>
        <input id="einwohner" name="einwohner" type="number" value="<?php if(isset($_POST['einwohner'])) echo htmlspecialchars($_POST['einwohner']) ?>"><br/>
        <label for="land">Land:</label>
        <input id="land" name="land" type="text" value="<?php if(isset($_POST['land'])) echo htmlspecialchars($_POST['land']) ?>"><br/>
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
