<div class="containere" style="height: 50vh;">
    <div class="landing-page top-news" style="height: 50vh;">
        <div class="page-content">
            <a href="/"><h1>Otacku attack</h1></a>
        </div>
    </div>
</div>
<section class="section-news" >
    <div class="container container-news decaled">
        <?php if ($user->hasFlash()) echo '<p style="text-align:center;">', $user->getFlash(), '</p>'; ?>
    <form method="post" action="/Videos-p-1">
        <p class="text-center">
            <br/>
            <label for="video">Mot clé : </label><input id="video" name="video" type="text" value="<?php echo isset($_SESSION['video']) ? $_SESSION['video'] : null ;?>">
            <input type="submit" value="Rechercher">
            <br>
            <br>
            <?php echo (isset($messageErreur)) ? $messageErreur."<br><br>" : null ; ?>
            <?php echo (isset($nombre_resultats)) ? "".$nombre_resultats." résultat(s)<br><br>" : null ; ?>
        </p>
    </form>
        <h1 style="text-align: center;"><?php echo isset($title) ? $title : null; ?></h1>
<?php
foreach ($listeVideos as $video){
?>
    <p class="text-center">
        <h2><a class="link-news-2" href="Videos-<?php echo $video['id'];?>"><?php echo $video['nom']; ?></a></h2>
        <video src="http://<?php echo $_SERVER['REMOTE_ADDR']."/Data/videos/Musique/".$video['artiste']."/".$video['nom'].".".$video['extention'];?>" width="100%" controls></video>
    </p>
<?php
}echo isset($pagination) ? $pagination : null;

?>
    </div>
</section>