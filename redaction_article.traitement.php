<?php

include("_fonction.inc.php");
session_start();


if (isset($_REQUEST)) {
    $article_titre = $_REQUEST['article_titre'];
    $article_contenu = $_REQUEST['article_contenu'];
    $idUtilisateur = $_SESSION['idUtilisateur'];

    $reussi = creerArticle($article_titre, $article_contenu, $idUtilisateur);
}
header('Location: index.php')
?>