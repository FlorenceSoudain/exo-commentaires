<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 23/01/2019
 * Time: 17:24
 */

include 'connection.php';
session_start();

if ($_SESSION['id'] !== NULL) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM commentaires WHERE id = '$id'";
    if ($connection->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
} else {
    echo "Vous n'étes pas connecté";
}