<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 23/01/2019
 * Time: 14:55
 */

session_start();

if (isset($_SESSION['id']) == NULL) {


    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <form class="formLogin" action="check_login.php" method="post">
        <div>
            <label for="username">Identifiant</label>
            <input id="username" type="text" name="username">
        </div>
        <div>
            <label for="password">Mot de passe </label>
            <input id="password" type="password" name="password">
        </div>
        <div>
            <input type="submit" name="button" value="Se connecter">
        </div>

    </form>
    </body>
    </html>
<?php
} else {
    echo "Vous êtes déjà connecté";
}