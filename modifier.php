<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 23/01/2019
 * Time: 17:24
 */

session_start();
echo "Bonjour " . $_SESSION['username'];
include 'connection.php';
$identifiant = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM commentaires WHERE id = $identifiant";
$result = $connection->query($sql);
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $nom = $row['username'];
    $commentaires = $row['commentaires'];
}
global $id, $nom, $commentaires;
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter une randonnée</title>
    </head>
    <body>
    <a href="index.php">Liste des données</a>
    <h1>Ajouter</h1>
    <form action="update2.php?id=<?php echo $id ?>" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $nom ?>">
        </div>

        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile" <?php echo $difficulte == 'très facile' ? 'selected' : ''?>>Très facile</option>
                <option value="facile"  <?php echo $difficulte == 'facile' ? 'selected' : ''?>>Facile</option>
                <option value="moyen"  <?php echo $difficulte == 'moyen' ? 'selected' : ''?>>Moyen</option>
                <option value="difficile"  <?php echo $difficulte == 'difficile' ? 'selected' : ''?>>Difficile</option>
                <option value="très difficile" <?php echo $difficulte == 'très difficile' ? 'selected' : ''?>>Très difficile</option>

            </select>
        </div>

        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="<?php echo $distance ?>">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="text" name="duration" value="<?php echo $duration ?>">
        </div>
        <div>
            <label for="height_difference">Dénivelé</label>
            <input type="text" name="height_difference" value="<?php echo $denivele ?>">
        </div>
        <div>
            <label for="available">Available</label>
            <input type="text" name="available" value="<?php echo $available ?>">
        </div>
        <input type="submit" name="button" value="Envoyer">
    </form>
    </body>
    </html>

<?php