<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/01/2019
 * Time: 14:41
 */

//page refactorisée contenant la connection à la base de données
include 'connection.php';

session_start();

//nombre de commentaires par page
$limit = 3;

//fonction récupérant et affichant les messages de la table des commentaires
function mess()
{
    global $connection, $limit, $depart;
    $sql = "SELECT id, username, commentaires, DATE_FORMAT(send_date, '%d/%m/%Y %Hh%imin%ss') AS date FROM commentaires WHERE 1
ORDER BY date DESC LIMIT $depart, $limit ";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $username = $row['username'];
        $message = $row['commentaires'];
        $sentDate = $row['date'];
        echo "<div class='mess'>" . nl2br($message) . "</div><br><div class='details'>Envoyé par " . $username . " le " . $sentDate . "</div><br>";
        if(isset($_SESSION['id']) != NULL){
            echo "<div><a href='modifier.php?id=".$id."'> Modifier </a> | <a href='supprimer.php?id=".$id."'> Supprimer </a></div><br>";
        }
    }
}

//fonction qui indique le nombre de pages et créé des liens pour chacune d'entres elles
function pagination()
{
    global $connection, $limit, $pageCourante;
    $sql = "SELECT COUNT(*) AS nbrcomm FROM commentaires";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        $nbrcomm = $row['nbrcomm'];
    }
    //calcul qui détermine le nombre de page en divisant le nombre de commentaire totale par le nombre de commentaire par page
    $nbrPage = ceil($nbrcomm/$limit);
    echo "Pages: ";
    for ($i = 1; $i <= $nbrPage; $i++) {
        //condition qui permet d'enlever le lien de la pagination quand on est sur la page et ainsi indiquer sur quelle page est ouverte
        if($i == $pageCourante){
            echo $i.' ';
        } else {
        echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';}
    }
}
//récupére la page
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0){
    $_GET['page'] = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}

//variable qui détermine le point de départ des commentaires pour chaque page
$depart = ($pageCourante-1)*$limit;

function connection(){
    if(isset($_SESSION['id']) == NULL){
    echo "<a href='login.php'>Se Connecter</a>";
} else {
        echo "Bonjour, " . $_SESSION['username'] . ". <a href='logout.php'>Se Déconnecter</a>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace commentaires</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Espace commentaires</h1>
<div><?php connection(); ?></div>
<h2>Commentaires : </h2>
<div id="message"><?php mess(); ?></div>
<div id="pagination"><?php pagination(); ?></div>
<h2>Laissez un commentaire</h2>
<br>
<form action="ajout.php" method="post">
    <label for="username"></label>
    <input id="username" name="username" placeholder="Pseudo"><br><br>
    <label for="message"></label>
    <textarea id="message" name="message" placeholder="Message"></textarea>
    <div>
    <input id="btn" type="submit" value="Envoyer">
    </div>
</form>

<script src="script.js"></script>
</body>
</html>
