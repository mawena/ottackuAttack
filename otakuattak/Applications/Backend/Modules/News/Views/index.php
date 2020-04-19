<p style="text-align: center">Il y a actuellement <?php echo $nombreNews; ?> news. En voici la liste :</p>
<table>
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Date d'ajout</th>
        <th>Dernière modification</th>
        <th>Action</th>
    </tr>
    <?php
    foreach ($listeNews as $news) {
        echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le ' . $news['dateModif']->format('d/m/Y à H\hi')),
            '</td><td><a href="/admin/News-update-',
            $news['id'],
            '"><img src="/images/update.png" width="30" alt="Modifier" /></a> <a href="/admin/News-delete-',
            $news['id'],
            '"><img src="/images/delete.png" width="30" alt="Supprimer" /></a></td></tr>',
            "\n";
    }
    ?>
</table>