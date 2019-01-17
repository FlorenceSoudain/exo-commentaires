<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/01/2019
 * Time: 14:41
 */

include 'connection.php';

function mess(){
    global $connection;
$sql = "SELECT username, commentaires, DATE_FORMAT(send_date, '%d/%m/%Y %Hh%imin%ss') AS date FROM commentaires WHERE 1";
$result = $connection -> query($sql);
while($row = $result -> fetch_assoc()){
    $username = $row['username'];
    $message = $row['commentaires'];
    $sentDate = $row['date'];
    echo "<div>" . $message . "</div><br><div>Envoyé par " . $username . " le " . $sentDate . "</div><br>";
}
}

global $username, $message, $sentDate;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace commentaires</title>
</head>
<body>
<h1>Espace commentaires</h1>
<div>Laissez un commentaire</div><br>
<form action="ajout.php" method="post">
    <label for="username">Pseudo</label>
    <input id="username" name="username"><br><br>
    <label for="message">Message</label>
    <textarea id="message" name="message"></textarea>
    <input type="submit" value="Envoyer">
</form>
<h2>Commentaires : </h2>
<div><?php mess(); ?></div>
</body>
</html>
