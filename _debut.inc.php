<?php
session_start();
include("_fonction.inc.php");

if (isset($_SESSION["login"])) {
    $connecte = true;
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Blog</title>
        <meta charset="utf-8" name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css"> 
        <link rel="stylesheet" href="css/fontawesome-all.min.css"></head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header"> <a class="navbar-brand" href="index.php">Blog</a> </div>
                <ul class="nav navbar-nav">
                    <?php if ($connecte == true): ?>                         
                        <li>
                            <a>  Bienvenue <?php echo $_SESSION['login']; ?> </a>
                        </li>
                    <?php endif; ?>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                    <li><a href="redaction_article.php">Rédaction</a></li>
                    
                    <?php if ($connecte == true): ?>
                        <li> 
    <!--                            <input type="button" class="btn btn-primary btn-sm" value="Se déconnecter" onclick="location.href = 'deconnexion.traitement.php'">-->
                            <img src="img/if_logout_54231.png" onclick="location.href = 'deconnexion.traitement.php'">
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>