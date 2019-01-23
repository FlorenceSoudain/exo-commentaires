<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 23/01/2019
 * Time: 15:12
 */

include 'connection.php';
$username = filter_var($_REQUEST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING);
$sql = "SELECT id, username, password FROM users WHERE username = '$username'";
$result = $connection->query($sql);
while ($row = $result->fetch_assoc()) {
    $DBID = $row['id'];
    $DBusername = $row['username'];
    $DBpassword = $row['password'];
}
global $DBusername, $DBpassword, $DBID;
if (isset($username) && isset($password)) {
    if ($DBusername == $username && $DBpassword == sha1($password)) {
        session_start();
        $_SESSION['id'] = $DBID;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location: index.php');
    }
    else {
        echo "Mauvais identifiant ou mot de passe.";
    }
}

echo $username.$password;