<section class="section-news" style="padding-top: 40px;" id="comments">
    <div class="container container-news">

        <p class="text-center"><br /><a href="Commenter-<?php echo ($_SESSION['module'] == "News") ? $element['id'] : "Videos-" . $element['id']; ?>" class="link-news-1">Ajouter un commentaire</a></p>
        <?php if (!isset($comments) || !$comments) { ?>
            <p class="text-center">Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
            <?php
        } else {
            foreach ($comments as $comment) {
            ?>
                <fieldset>
                    <legend id="<?php echo $comment['id']; ?>">
                        Posté par <strong> <?php echo htmlspecialchars($comment['auteur']); ?></strong> le <em><?php echo $comment['date']->format('d/m/Y à H/hi'); ?></em>
                        <?php if ($user->isAuthenticated()) { ?> -<a href="admin/Comment-update-<?php echo $comment['id']; ?>">Modifier</a><?php } ?>
                        <?php if ($user->isAuthenticated()) { ?> -<a href="admin/Comment-delete-<?php echo $comment['id']; ?>">Suprimer</a><?php } ?>
                    </legend>
                    <p><?php echo nl2br(htmlspecialchars($comment['contenu'])) ?></p>
                </fieldset>
        <?php
            }
        }
        ?>
        <p class="text-center"><a href="Commenter-<?php echo ($_SESSION['module'] == "News") ? $element['id'] : "Videos-" . $element['id'] ?>" class="link-news-1">Ajouter un commentaire</a><br /><br /></p>
    </div>
</section>