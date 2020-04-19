<div class="containere" style="height: 50vh;">
    <div class="landing-page top-news" style="height: 50vh;">
        <div class="page-content">
            <a href="/"><h1>I-Space</h1></a>
        </div>
    </div>
</div>
<section class="section-news">
    <br/>
    <div class="container container-news decaled" style = "height: 70vh;">
        <h2 class="text-center"><br/>Ajouter un commentaire</h2>
        <form action="" method="post">
            <p class="text-center">
                <?php if(isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) echo "L'auteur est invalide<br/>";?>
                <label for="pseudo">Pseudo</label>
                <input id="pseudo" type="text" name="pseudo" value="<?php if(isset($comment)) echo htmlspecialchars($comment['auteur']);?>" />
                <br/>
                <br/>
                <?php if(isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) echo "Le contenu est invalide<br/>";?>
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" cols="50" rows="7"><?php if(isset($comment)) echo htmlspecialchars($comment['contenu']);?></textarea>
                <br>
            </p>
            <a href="/Videos-<?php echo $_GET['video']?>" class="link-news-2" p>Retour</a>
            <input class="link-news-2 pull-right" type="submit" value="commenter"/>
        </form>
    </div>
    <br/>
</section>