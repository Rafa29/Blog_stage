<?php
include('_debut.inc.php');


if (!isset($_REQUEST["numArticle"])) {
    header("location: consultationEtablissements.php");
}

$codeArticle = $_REQUEST['numArticle'];

$article = lireArticle($codeArticle);

if ($article != false) {
    $titre = $article['titre'];
    $contenu = $article['article'];
    $date = $article['dateArticle'];
    $auteur = $article['prenom'];
}
?>

<div class="container">
    <div class="row ">

        <div class="col-md-12 ">
            <article>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $titre; ?></h3>
                    </div>
                    <div class="panel-body">
                        <p> <?php echo $contenu; ?> </p><br>
                        <p> Rédigé le : <?php echo $date; ?> </p>
                        <p>Par : <?php echo $auteur; ?> </p>
                    </div>
                </div> 
            </article>
        </div>
    </div>



</div> <!-- /container -->





