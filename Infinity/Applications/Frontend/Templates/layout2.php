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
    <link rel="stylesheet" href="/CSS/Style2.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <input type="checkbox" id="menu" />
    <label for="menu" class="menu">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <?php echo (isset($menu)) ? $menu : null; ?>
    <main>
        <?php if ($user->hasFlash()) echo '<p style="text-align:center;">', $user->getFlash(), '</p>'; ?>
        <?php echo $content; ?>
        <footer>
            <div class="logo">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div>
            <div class="secondary-links">
                <ul>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
                <ul class="social">
                    <li><a href="#">
                            <i class="fa fa-github"></i>
                        </a></li>
                    <li><a href="#">
                            <i class="fa fa-twitter"></i>
                        </a></li>
                    <li><a href="#">
                            <i class="fa fa-codepen"></i>
                        </a></li>
                </ul>
            </div>
        </footer>
    </main>
</body>

</html>