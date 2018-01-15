<?php include("_debut.inc.php"); 
?>

<!--if(isset($_POST['article_titre'], $_POST['article_contenu'])){
    if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])){
        
        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);
        $idUtilisateur = $_SESSION['idUtilisateur'];
        
        
        $ins = $pdo->prepare('INSERT INTO Article(titre, article, dateArticle, idUtilisateur) VALUES (?, ?, NOW(), ?)');
        $ins->execute(array($article_titre, $article_contenu, $idUtilisateur));
        
        $message = 'Votre article à bien été posté';
    }
    else{
        $message ="Veuillez remplir tous les champs";
        
    }
}-->

<h2>Rédaction article</h2>

<form method="post" action="redaction_article.traitement.php">
    <div class="form-group">
        <input name="article_titre" type="text" placeholder="titre" class="form-control" required>
    </div>
    <div class="form-group">
        <textarea name="article_contenu" class="form-control" placeholder="Contenu de l'article" required></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Envoyer l'article">
    </div>
</form>
<?php
if(isset($message)) {echo $message;}
?>