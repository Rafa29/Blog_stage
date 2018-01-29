<?php
include('header.php');


if(isset($_POST['submitArticle']))
{
    if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {

        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);
        $id_membre = $_SESSION['idMembre'];

        
            $ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_article, idMembre) VALUES (?, ?, NOW(), ?)');
            $ins->execute(array($article_titre, $article_contenu, $id_membre));
            $msg = "<span style='color:green'>Votre article a bien été posté !</span>";
        
    }
    else
    {
        $msg = "Tous les champs doivent êtres complétés !";
    }
}
?>


<?php if(isset($_SESSION['idMembre'])) { ?> 

<h3>Rédaction</h3>
<form method="post">
    <input type="text" name="article_titre" placeholder="Titre"><br />
    <textarea name="article_contenu" placeholder="Contenu de l'article"></textarea><br />
    <input type="submit" name="submitArticle" value="Envoyer l'article" />
</form>
<?php }else { $msg = "<span style='color:red'>Vous devez être connecter !</span>"; }  ?>


<?php 
if(isset($msg))
{
    echo $msg;
}
?>