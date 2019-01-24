<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 23/01/2019
 * Time: 17:24
 */

session_start();

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

$click = isset($_POST['button']);

if($click){
    $modif = $_POST['modifcomm'];
$stmt = $connection->prepare("UPDATE commentaires SET id = ?,
   `username` = ?,
   `commentaires` = ?,
   `send_date` = ?
   WHERE `id` = $id");
$stmt->bind_param('isss',
    $id,
    $nom,
    $modif,
    $send);
if($stmt->execute()){
    header('Location: index.php');
}
$stmt->close();

}
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Commentaires</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <h1>Modifier</h1>
    <form action="" method="post">
        <div>
            Nom d'utilisateur : <?php echo $nom ?>
        </div>

        <div>
            <label for="message">Commentaire</label>
            <textarea id="message" name="modifcomm"> <?php echo $commentaires ?></textarea>
        </div>

        <input type="submit" name="button" value="Envoyer">
    </form>
    </body>
    </html>

<?php