<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/01/2019
 * Time: 11:10
 */

include 'connection.php';

session_start();

$click = isset($_POST['button']);
if($click == TRUE){
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$stmt = $connection -> prepare('INSERT INTO users VALUES (?,?,?)');
$stmt -> bind_param("iss", $id, $username, sha1($password));
if($stmt -> execute()) {
    header('Location: login.php');
} else {
    echo "Echec de l'inscription";
}
$stmt -> close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form class="formInscription" action="" method="post">
    <div>
        <label for="username">Identifiant</label>
        <input id="username" type="text" name="username">
    </div>
    <div>
        <label for="password">Mot de passe </label>
        <input id="password" type="password" name="password">
    </div>
    <div>
        <input type="submit" name="button" value="S'inscrire">
    </div>

</form>
</body>
</html>
