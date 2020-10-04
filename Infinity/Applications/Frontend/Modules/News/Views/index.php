<div class="containere" style="height: 50vh;">
    <div class="landing-page top-news" style="height: 50vh;">
        <div class="page-content">
            <a href="/"><h1>Otacku attack</h1></a>
        </div>
    </div>
</div>
<section class="section-news">
    <div class="container container-news decaled">
        <h1 style="text-align: center;"><?php echo isset($title) ? $title : null; ?></h1>
      <?php if ($user->hasFlash()) echo '<p style="text-align:center;">', $user->getFlash(), '</p>'; ?>
<?php
foreach ($listeNews as $news){
?>
        <div>
            <h2><a class="link-news-1" href="News-<?php echo $news['id'];?>"><?php echo $news['titre']; ?></a></h2>
            <p><?php echo nl2br($news['contenu']); ?></p>
        </div>
<?php
}
?>  <br>
    </div>
</section>