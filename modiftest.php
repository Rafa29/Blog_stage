<?php
include('header.php');

?>

<?php if(isset($_SESSION['idMembre'])) 
{ 

    $getid = intval($_GET['idArticle']);
    $user_art = $bdd->prepare("SELECT * FROM articles WHERE idArticle = ?");
    $user_art->execute(array($getid));

    $a = $user_art->fetch();


 if($a['idArticle'] == $_GET['idArticle']) {

$msg="ok";

}
 else
 {
   
     header("Location: profil.php?idMembre=".$_SESSION['idMembre']);
 }?>






<h3>Rédaction</h3>
<form method="post">
    <input type="text" name="article_titre" placeholder="Titre"/><br />
    <textarea name="article_contenu" placeholder="Contenu de l'article"></textarea><br />
    <input type="submit" name="submitArticle" value="Envoyer l'article" />
</form>
<?php }
else 
{ 
    $msg = "<span style='color:red'>Vous devez être connecter !</span>"; 
}  ?>


<?php 
if(isset($msg))
{
    echo $msg;
}
?>