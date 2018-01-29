<?php
include('header.php');

$articles = $bdd->query("SELECT * FROM articles ORDER BY date_article DESC");
?>




<h3>Accueil</h3>
<ul>
    <?php while($a = $articles->fetch()) { ?>
    <li><a href="article.php?idArticle=<?= $a['idArticle'] ?>"><?= $a['titre']; ?></a>
    <?php } ?>
</ul>

