<?php

include("_fonction.inc.php");

if(isset($_REQUEST)) {
    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom'];
    $email = $_REQUEST['email'];
    $adresse = $_REQUEST['adresse'];
    $ville = $_REQUEST['ville'];
    $cp = $_REQUEST['cp'];
    $login = $_REQUEST['login'];
    $mdp = $_REQUEST['mdp'];
    
    $reussi = creerUtilisateur($nom, $prenom, $email, $adresse, $ville, $cp, $login, $mdp);

}

header('Location:inscription.php')


?>