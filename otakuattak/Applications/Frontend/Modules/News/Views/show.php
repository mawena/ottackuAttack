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

            <p>Par <em><?php echo $element['auteur']; ?></em>, le <?php echo $element['dateAjout']->format('d/m/Y à H\hi'); ?></p>
            <em>
                <h2><?php echo $element['titre']; ?></h2>
            </em>
            <p><?php echo nl2br($element['contenu']); ?></p>
            <?php if ($element['dateAjout'] != $element['dateModif']) { ?>
                <p style="text-align: right;"><small><em>Modifiée le <?php echo $element['dateModif']->format('d/m/Y à H\hi'); ?></em></small></p>
            <?php } ?>
            <a href="/News" class="link-news-1">Retour</a><br><br>
        </div>
    </div>
</section>
<?php
$_SESSION['module'] = 'News';
require '_comments.php';
