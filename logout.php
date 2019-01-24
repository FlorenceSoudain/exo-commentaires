<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 24/01/2019
 * Time: 14:37
 */


include 'connection.php';
session_start();
if ($_SESSION['id'] != NULL) {
    echo "Voulez-vous vous déconnecter, " . $_SESSION['username'] . " ?";
    $logout = filter_var(isset($_REQUEST['button']), FILTER_SANITIZE_URL);
    if ($logout == TRUE) {
        session_destroy();
        header('Location: index.php');
    }
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Logout</title>
    </head>
    <body>

    <form action="" method="post">
        <div>
            <input type="submit" name="button" value="Se déconnecter">
        </div>
    </form>
    </body>
    </html>

    <?php
} else {
    echo "Vous n'étes pas connecté. <a href='login.php'>Vous connecter ?</a>";
}