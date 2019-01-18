<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/01/2019
 * Time: 14:41
 */

//page refactorisée contenant la connection à la base de données
include 'connection.php';

$limit = 3;

//fonction récupérant les données dans la table des commentaires
function mess()
{
    global $limit;
    global $connection;
    $sql = "SELECT username, commentaires, DATE_FORMAT(send_date, '%d/%m/%Y %Hh%imin%ss') AS date FROM commentaires WHERE 1
ORDER BY date DESC LIMIT $limit";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $message = $row['commentaires'];
        $sentDate = $row['date'];
        echo "<div>" . nl2br($message) . "</div><br><div>Envoyé par " . $username . " le " . $sentDate . "</div><br>";
    }
}

function pagination()
{
    global $connection, $limit;
    $sql = "SELECT COUNT(*) AS nbrcomm FROM commentaires";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        $nbrcomm = $row['nbrcomm'];
    }
    $nbrPage = ceil($nbrcomm/$limit);
    echo "Pages: ";
    for ($i = 1; $i <= $nbrPage; $i++) {
        echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace commentaires</title>
</head>
<body>
<h1>Espace commentaires</h1>
<div>Laissez un commentaire</div>
<br>
<form action="ajout.php" method="post">
    <label for="username">Pseudo</label>
    <input id="username" name="username"><br><br>
    <label for="message">Message</label>
    <textarea id="message" name="message"></textarea>
    <input type="submit" value="Envoyer">
</form>
<h2>Commentaires : </h2>
<div><?php mess(); ?></div>
<div><?php pagination(); ?></div>

</body>
</html>
