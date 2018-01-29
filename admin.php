<?php
include('header.php');

$membres = $bdd->prepare("SELECT * FROM membres WHERE type is null ORDER BY idMembre ");
$membres->execute(array()); 


$articles = $bdd->prepare("SELECT a.idArticle, titre, contenu, pseudo, date_article FROM articles a, membres m WHERE a.idMembre = m.idMembre ORDER BY date_article DESC");
$articles->execute(array());



$commentaires = $bdd->prepare("SELECT c.idCommentaire, commentaire, date_Commentaire, idArticle, pseudo FROM commentaires c, membres m WHERE c.idMembre = m.idMembre ORDER BY date_Commentaire DESC");
$commentaires->execute(array());


?>


<?php
if(isset($_SESSION['idMembre'])) { 

    $getid = $_SESSION['idMembre'];
    $requser = $bdd->prepare("SELECT * FROM membres WHERE idMembre = ?");
    $requser->execute(array($getid));

    $userinfo = $requser->fetch();

    if($userinfo['type'] == 1)
    {?>

<h2>Les membres</h2>
<ul>
    <?php while($m = $membres->fetch()) { ?>
    <li><b>Id :</b> <?= $m['idMembre'] ?> </li>
    <li><b>Pseudo :</b> <?= $m['pseudo'] ?> </li>
    <li><b>Mail :</b> <?= $m['mail'] ?> </li>
    <a href="admin.php?idMembre=<?= $m['idMembre'] ?>">Supprimer</a></li><br /><br />
<?php } ?>
</ul>


<h2>Les articles</h2>
<ul>
    <?php while($a = $articles->fetch()) { ?>
    <li><b>Id :</b> <?= $a['idArticle'] ?> </li>
    <li><b>Titre :</b> <?= $a['titre'] ?> </li>
    <li><b>Contenu :</b> <?= $a['contenu'] ?> </li>
    <li><b>Posté par :</b> <?= $a['pseudo'] ?> <b>le </b> <?= $a['date_article'] ?></li>
    <a href="modification_admin.php?idArticle=<?= $a['idArticle'] ?>">Modifier</a> |
    <a href="admin.php?idArticle=<?= $a['idArticle'] ?>">Supprimer</a></li><br /><br />
<?php } ?>
</ul>

<h2>Les commentaires</h2>
<ul>
    <?php while($c = $commentaires->fetch()) { ?>
    <li><b>Id :</b> <?= $c['idCommentaire'] ?> </li>
    <li><b>Commentaire :</b> <?= $c['commentaire'] ?> </li>
    <li><b>Posté par :</b> <?= $c['pseudo'] ?> <b>le </b> <?= $c['date_Commentaire'] ?></li>
    <li><b>Concerne l'article :</b> <?= $c['idArticle'] ?> </li>
    <a href="admin.php?idCommentaire=<?= $c['idCommentaire'] ?>">Supprimer</a></li><br /><br />
<?php } ?>
</ul>






<?php }
    else
    {
        header("Location: profil.php?idMembre=".$_SESSION['idMembre']);
    }




}
else{
    header("Location: index.php");
}
?>




<?php if(isset($_GET['idCommentaire'])) {

    $id_commentaire = htmlspecialchars($_GET['idCommentaire']);
    supprimer_commentaire($id_commentaire);
    header("Location: admin.php");

}?>

<?php if(isset($_GET['idArticle'])) {

    $id_article = htmlspecialchars($_GET['idArticle']);
    supprimer_commentaire_by_article($id_article);
    supprimer_article($id_article);
    header("Location: admin.php");
}?>


<?php if(isset($_GET['idMembre'])) {

    $id_membre = htmlspecialchars($_GET['idMembre']);
    supprimer_article_by_membre($id_membre);
    supprimer_membre($id_membre);
    supprimer_commentaire_autre();
    header("Location: admin.php");
}?>