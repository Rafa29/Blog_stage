<?php

include('_fonction.inc.php');
session_start();
if (isset($_REQUEST["login"]) AND isset($_REQUEST["mdp"])) {
    $resultat = verification($_REQUEST["login"], $_REQUEST["mdp"]);
    if ($resultat == true) {
        $_SESSION["login"] = $resultat["login"];
        $_SESSION["mdp"] = $resultat["mdp"];
        $_SESSION["idUtilisateur"] = $resultat["idUtilisateur"];
        header("Location:index.php");
    } else {
        header("Location:espaceClient.php");
    }
}
?>