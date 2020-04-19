<?php

namespace Library\Models;

use \Library\Entities\News;

class NewsManager_PDO extends NewsManager
{
    public function delete(int $id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = ' . (int) $id);
    }
    protected function modify(News $news)
    {
        $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
        $requete->execute();
    }
    protected function add(News $news)
    {
        $requete = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->execute();
    }
    public function getList($debut = -1, $limite = -1)
    {
        $sql = "SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC";

        //Vérification de l'intégrité des paramètres fournis et finition de la requête sql
        ($debut != -1 || $limite != -1) ? $sql .= " LIMIT " . (int) $limite . " OFFSET " . (int) $debut : NULL;
        $requete = $this->dao->query($sql);

        foreach ($requete->fetchAll() as $news) {
            $listeNews[] = new News($news);
        }   //Remplissage du tableau de news
        foreach ($listeNews as $news) {
            $news->setDateAjout(new \DateTime($news->dateAjout()));
            $news->setDateModif(new \DateTime($news->dateModif()));
        }
        $requete->closeCursor();
        return $listeNews;
    }
    public function getUnique($id)
    {
        $news_array = ($this->dao->query('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id =' . (int) $id))->fetch();
        ($news_array) ? $news = new News($news_array) : null;
        if (isset($news) && $news) {
            $news->setDateAjout(new \DateTime($news_array['dateAjout']));
            $news->setDateModif(new \DateTime($news_array['dateModif']));
        }
        return isset($news) ? $news : null;
    }
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }
}
