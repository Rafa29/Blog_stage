<?php
include('_debut.inc.php');
?>
<h2>Articles</h2>
<div class="container">
    <!-- ligne principale -->
    <div class="row ">

        <!-- deuxième colonne (s'étend sur 7 colonnes sur 12 possibles à partir de la 3) -->
        <div class="col-md-12 ">
            <br />
            <!-- une ligne dans une colonne -->
            <div class="row">
                <?php
                $listeArticles = listeArticles();
                foreach ($listeArticles as $articles):
                    ?> 

                    <div class="col-md-12">
                        <article class="panel panel-default articleEtablissement bgColorTheme">
                            <p> Titre : <?php echo $articles["titre"] ?>  </p>
                            <p> Date : <?php echo $articles["dateArticle"] ?>  </p>
                            <p> Par : <?php echo $articles["prenom"] ?>  </p>
                            <ol class="breadcrumb">
                                <li> 
                                    <a href="detailArticle.php?numArticle=<?php echo $articles["codeArticle"] ?>">lire l'article
                                    </a>
                                </li>
                                <li> 
                                    <a href="modificationEtablissement.php?numEtablissement=<?php echo $etablissement["id"] ?>">modifier
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="suppressionEtablissement.php?numEtablissement=<?php echo $etablissement["id"] ?>">Suppression
                                    </a>
                                </li>
                            </ol>
                        </article>
                    </div>

                <?php endforeach; ?>                




            </div>
        </div>
    </div>



</div> <!-- /container -->