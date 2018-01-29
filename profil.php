<?php
include('header.php');



//--------------------------------Parti pour recuperer tous les info selon un membre, recherche par son id-------------------------------

//---------------------------------------------------------------------------------------------------------------------------------------


//------------------------------------------Parti pour recuperer tous les articles d'un membre ------------------------------------------

//---------------------------------------------------------------------------------------------------------------------------------------


//------------------------------------Parti pour recuperer les commentaires de chaque membre---------------------------------------------



//---------------------------------------------------------------------------------------------------------------------------------------


if(isset($_SESSION['idMembre']))
{


    $getid = intval($_GET['idMembre']);
    $requser = $bdd->prepare("SELECT * FROM membres WHERE idMembre = ?");
    $requser->execute(array($getid));

    $userinfo = $requser->fetch();

    if($userinfo['idMembre'] == $_SESSION['idMembre'])
    {

        $req_art_user = $bdd->prepare("SELECT * FROM articles WHERE idMembre = ? ORDER BY date_article DESC");
        $req_art_user->execute(array($getid));


        $req_comment_user = $bdd->prepare("SELECT * FROM commentaires WHERE idMembre = ? ORDER BY date_Commentaire DESC");
        $req_comment_user->execute(array($getid));?>
<h3>Profil de <?php echo $userinfo['pseudo']; ?></h3>
<br> Pseudo =
<?php echo $userinfo['pseudo']; ?>
<br> Mail =
<?php echo $userinfo['mail']; ?>
<br>
<?php if ($userinfo['type'] == 1 ) { ?> <a href="editionProfil.php">Editer mon profil</a>
<br /> <a href="admin.php">Parti Administration</a>
<br />
<br />
<?php } else{ ?> <a href="editionProfil.php">Editer mon profil</a>
<br />
<br />
<?php } ?>
<?php if($req_art_user->rowCount() >= 1){ ?>
<h3>Mes articles</h3>
<?php while($a = $req_art_user->fetch()) { ?> <b><?= $a['titre'] ?>:</b>
<br /> <b><?= $a['contenu'] ?></b>
<br /> <b>Posté le: <?= $a['date_article'] ?></b>
<br /> <a href="modification.php?idArticle=<?= $a['idArticle'] ?>">Modifier</a> | <a href="profil.php?idArticle=<?= $a['idArticle'] ?>">Supprimer</a></li>
<br />
<br />
<?php } ?>
<?php }else{ ?>
<p>Vous n'avez posté aucun article !</p>
<?php } ?>
<?php if($req_comment_user->rowCount() >= 1){ ?>
<h3>Mes commentaires</h3>
<?php while($c = $req_comment_user->fetch()) { ?> <b><?= $c['commentaire'] ?>:</b>
<br /> <b>Posté le: <?= $c['date_Commentaire'] ?></b>
<br /> <a href="profil.php?idCommentaire=<?= $c['idCommentaire'] ?>">Supprimer</a></li>

<br />
<br />
<?php } ?>
<?php }else{ ?>
<p>Vous n'avez posté aucun commentaire !</p>
<?php } ?>
<?php }
    else
    {
        header("Location: profil.php?idMembre=".$_SESSION['idMembre']);
    }



}
else
{
    $msg = "<span style='color:red'>Veuillez vous connecter pour accéder à votre profil !</span>";
}
?>

<?php if(isset($_GET['idCommentaire'])) {

    $id_commentaire = htmlspecialchars($_GET['idCommentaire']);
    supprimer_commentaire($id_commentaire);
    
}?>

<?php if(isset($_GET['idArticle'])) {

    $id_article = htmlspecialchars($_GET['idArticle']);
    supprimer_commentaire_by_article($id_article);
    supprimer_article($id_article);
    
}?>


<?php if(isset($msg)) { echo $msg; } ?>