<?php
include('header.php');

if(isset($_GET['idArticle']) AND !empty($_GET['idArticle']))
{
    $get_id = htmlspecialchars($_GET['idArticle']);



    //------------------------------Parti pour les commentaires------------------




    if(isset($_POST['submit_commentaire']))
    {
        if(isset($_POST['commentaire']) AND !empty($_POST['commentaire']))
        {
            $id_membre = $_SESSION['idMembre'];
            $commentaire = htmlspecialchars($_POST['commentaire']);

            $ins = $bdd->prepare("INSERT INTO commentaires (commentaire, date_Commentaire, idArticle, idMembre) VALUES (?, NOW(), ?, ?)");
            $ins->execute(array($commentaire, $get_id, $id_membre));

            $c_msg = "<span style='color:green'>Votre commentaire à bien été posté !</span>";

        }
        else
        {
            $c_msg = "Le champs n'a pas été complété";
        }
    }

    $commentaires = $bdd->prepare("SELECT * FROM commentaires c, membres m WHERE idArticle = ? AND c.idMembre = m.idMembre ORDER BY c.idCommentaire DESC");
    $commentaires->execute(array($get_id));


    //---------------------------------parti pour l'affichage de l'article---------------------------------------

    $article = $bdd->prepare("SELECT * FROM articles a, membres m WHERE a.idArticle = ? AND a.idMembre = m.idMembre ");
    $article->execute(array($get_id));

    if($article->rowCount() == 1)
    {
        $article = $article->fetch();
        $titre = $article['titre'];
        $contenu = $article['contenu'];
        $date_publi = $article['date_article'];
        $posteur = $article['pseudo'];


    }
    else
    {
        die('Cet article n\'existe pas !');
    }

}
else
{
    die('Erreur');
}

?>




<h1><?= $titre ?></h1>
<p><?= $contenu ?></p>
<b>Par <?= $posteur ?>, le <?= $date_publi ?></b><br />


<br />

<h2>Commentaires</h2>
<?php while($c = $commentaires->fetch()) { ?>
<b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?> <br />
<b><?= $c['date_Commentaire'] ?></b><br /><br />
<?php } ?>

<h3>Ecrire un commentaire</h3>
<?php if(isset($_SESSION['idMembre'])) { ?> 
<form method="post">
    <textarea name="commentaire" placeholder="commentaire"></textarea><br /><br />
    <input type="submit" value="poster commentaire" name="submit_commentaire" />
</form>
<?php }else { $c_msg = "<span style='color:red'>Vous devez être connecter !</span>"; }  ?>

<?php if(isset($c_msg)) { echo $c_msg; }  ?>

