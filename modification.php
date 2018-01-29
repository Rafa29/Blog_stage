<?php
include('header.php');

?>

<?php if(isset($_SESSION['idMembre'])) 
{ ?>

    
    <?php if(isset($_GET['idArticle']))
    {

        $get_id_membre = $_SESSION['idMembre'];
        $getid = intval($_GET['idArticle']);
        $user_art = $bdd->prepare("SELECT * FROM articles WHERE idArticle = ? AND idMembre = ? ");
        $user_art->execute(array($getid, $get_id_membre));

        $a = $user_art->fetch();

        if($a['idArticle'] == $_GET['idArticle'] AND $a['idMembre'] == $_SESSION['idMembre'])
        {
            
            if(isset($_POST['submitArticle']))
            {
            
                if(!empty($_POST['new_titre']) AND !empty($_POST['new_contenu'])){
                    
                    $new_titre = htmlspecialchars($_POST['new_titre']);
                    $new_contenu = htmlspecialchars($_POST['new_contenu']);
                    $getid = intval($_GET['idArticle']);
                    
                    
                    $upd_art = $bdd->prepare("UPDATE articles SET titre = ?, contenu = ?, date_article = NOW() WHERE idArticle = ? ");
                    $upd_art->execute(array($new_titre, $new_contenu, $getid));
                    header('Location: article.php?idArticle='.$getid);
                    
                    
                    
                }
                else
                {
                    $msg = "Tous les champs doivent êtres complétés !";
                }
                
                
                
                
                
            }
            
            
        }
        else
        {
            header("Location: profil.php");

        }





    }
    else
    {
        header("Location: profil.php");
    }?>



 <h3>Modification</h3>
    <form method="post">
    <input type="text" name="new_titre" placeholder="Titre" value="<?php echo $a['titre']; ?> "/><br />
    <textarea name="new_contenu" placeholder="Contenu de l'article"><?php echo $a['contenu']; ?></textarea><br />
    <input type="submit" name="submitArticle" value="Envoyer l'article" />
    </form>
 
 
<?php }
else
{
    $msg = "<span style='color:red'>Vous devez être connecter !</span>"; 
}?>










<?php 
if(isset($msg))
{
    echo $msg;
}
?>