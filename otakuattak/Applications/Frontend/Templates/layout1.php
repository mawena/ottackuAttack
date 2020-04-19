<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <meta charset="utf-8" />
    <title>
        <?php if (!isset($title)) { ?>
            Mon super site
        <?php } else {
            echo $title;
        } ?>
    </title>
    <!-- <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" /> -->
    <!-- <link rel="stylesheet" href="/CSS/Envision.css" type="text/css"/> -->
    <link rel="stylesheet" href="/CSS/Style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php if ($user->isAuthenticated()) { ?>
    <div id="wrap" class="text">
        <div id="menu">
            <ul>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
            </ul>
        </div>
    </div>
<?php } ?>

<body>
    <div id="content-wrap">
        <div id="main">
            <?php if ($user->hasFlash()) echo '<p style="text-align:center;">', $user->getFlash(), '</p>'; ?>
            <?php echo $content; ?>
        </div>
    </div>
    <div id="footer"></div>
    </div>
    <?php echo (isset($menu)) ? $menu : null; ?>
    <!--On affiche un menu s'il y'en a -->
</body>

</html>