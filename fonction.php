<?php

function gestionnaireDeConnexion() {
    $bdd = NULL;
    try {
        $bdd =new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','');
    } catch (PDOException $err) {
        $messageErreur = $err->getMessage();
        error_log($messageErreur, 0);
    }
    return $bdd;
}



//------------------------Suppresion d'un commentaire seul---------------------------------------------------------------------------
function supprimer_commentaire($id_commentaire){
    $id_commentaire = htmlspecialchars($_GET['idCommentaire']);

    $bdd = gestionnaireDeConnexion();

    $suppr_comm = $bdd->prepare('DELETE FROM commentaires WHERE idCommentaire = ?');
    $suppr_comm->execute(array($id_commentaire));
}


//------------------Suppresion d'un article mais étant donnée que lors de la suppresion d'un article on supprime aussi les-----------
//---------------------commentaires associés à l'article, on a la fonction supprimer_commentaire_by_article--------------------------

function supprimer_article($id_article)
{
    $id_article = htmlspecialchars($_GET['idArticle']);

    $bdd = gestionnaireDeConnexion();

    $suppr_art = $bdd->prepare('DELETE FROM articles WHERE idArticle = ?');
    $suppr_art->execute(array($id_article));
}


function supprimer_commentaire_by_article($id_article)
{
    $id_article = htmlspecialchars($_GET['idArticle']);

    $bdd = gestionnaireDeConnexion();

    $suppr_comm = $bdd->prepare('DELETE FROM commentaires WHERE idArticle = ?');
    $suppr_comm->execute(array($id_article));
}
//------------------------------------------------------------------------------------------------------------------------------------




function supprimer_membre($id_membre)
{
    $id_membre = htmlspecialchars($_GET['idMembre']);

    $bdd = gestionnaireDeConnexion();

    $suppr_membre = $bdd->prepare('DELETE FROM membres WHERE idMembre = ?');
    $suppr_membre->execute(array($id_membre));
}


function supprimer_article_by_membre($id_membre)
{
    $id_membre = htmlspecialchars($_GET['idMembre']);

    $bdd = gestionnaireDeConnexion();

    $suppr_art = $bdd->prepare('DELETE FROM articles WHERE idMembre = ?');
    $suppr_art->execute(array($id_membre));
}

function supprimer_commentaire_autre()
{
    $bdd = gestionnaireDeConnexion();
    
    $supp_comm = $bdd->prepare('DELETE FROM commentaires WHERE idArticle NOT IN (select idArticle from articles)');
    $supp_comm->execute(array());
}


?>