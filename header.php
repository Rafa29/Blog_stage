<?php
session_start();
include('fonction.php');

$bdd =new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','');






?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HOME</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css"> </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header"> <a class="navbar-brand" href="index.php">Blog</a> </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="redaction.php">Rédaction</a></li>
                    <?php if(isset($_SESSION['idMembre'])) { ?> 
                    <li><a href="profil.php?idMembre=<?= $_SESSION['idMembre'] ?>">Mon profil</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION['idMembre'])) { 
                    $getid = $_SESSION['idMembre'];
                    $requser = $bdd->prepare("SELECT * FROM membres WHERE idMembre = ?");
                    $requser->execute(array($getid));

                    $userinfo = $requser->fetch();

                    if($userinfo['type'] == 1)
                    {?>
                       <li><a href="admin.php">Administration</a></li> 
                    <?php }
                     } ?>










                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['idMembre'])) { ?>                         
                    <li><a>  Bienvenue <?php echo $_SESSION['pseudo']; ?> </a></li>
                    <?php }else { ?>
                    <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span>Connexion</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION['idMembre'])) { ?> 
                    <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-in"></span>Déconnexion</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>