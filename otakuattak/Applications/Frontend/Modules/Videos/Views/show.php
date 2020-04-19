<div class="containere" style="height: 50vh;">
    <div class="landing-page top-news" style="height: 50vh;">
        <div class="page-content">
            <a href="/">
                <h1>Otacku attack</h1>
            </a>
        </div>
    </div>
</div>
<section class="section-news">
    <div class="container container-news">
        <h1 class="text-center"><?php echo isset($title) ? $title : null; ?></h1>
        <?php if ($user->hasFlash()) echo '<p class="text-center">', $user->getFlash(), '</p>'; ?>
        <div class="decaled">
            <p>
                <p><br />Nom :<em><strong><?php echo $element['nom']; ?></strong></em>, Ajouté le <?php echo $element['dateAjout']->format('d/m/Y à H\hi'); ?></p>
                <video src="/videos/Musique/<?php echo $element['artiste'] . "/" . $element['nom'] . $element['extention']; ?>" width="100%" controls></video>
                <p><?php echo nl2br($element['description']); ?></p>
                <a href="/Videos" class="link-news-2">Retour</a>
            </p>
            <br>
        </div>
    </div>
</section>
<?php
$_SESSION['module'] = 'Videos';
require __DIR__ . "/../../News/Views/_comments.php";
