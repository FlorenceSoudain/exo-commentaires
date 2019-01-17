<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/01/2019
 * Time: 15:40
 */

include 'connection.php';

$username = filter_var($_REQUEST['username'], FILTER_SANITIZE_STRING);
$message = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING);

$stmt = $connection -> prepare("INSERT INTO commentaires VALUES (?,?,?,now())");
$stmt -> bind_param('iss', $id, $username, $message);

if($stmt -> execute() == TRUE){
    header('Location: index.php');
} else {
    echo "Echec de l'envoie";
}
$stmt -> close();