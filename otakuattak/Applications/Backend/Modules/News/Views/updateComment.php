<form action="" method="post">
    <p>
        <!-- <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
        <label>Pseudo</label><input type="text" name="pseudo" value="<?php echo htmlspecialchars($comment['auteur']); ?>" /><br />

        <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
        <label>Contenu</label><textarea name="contenu" rows="7" cols="50"><?php echo htmlspecialchars($comment['contenu']); ?></textarea><br /> -->

        <?php echo $form ?>;
        <input type="hidden" name="elementId" value="<?php echo $comment['elementId']; ?>" />
        <input type="submit" value="Modifier" />
    </p>
</form>