<?php

namespace Library\Models;

use \Library\Entities\News;

abstract class NewsManager extends \Library\Manager
{
    /**
     * Méthode permettant de suprimmer une news
     * @param $id int l'identifiant de la news
     * @return void
     */
    abstract public function delete(int $id);

    /**
     * Méthode permettant de modifier une news
     * @param $news News La news à modifier
     * @return void
     */
    abstract protected function modify(News $news);

    /**
     * Méthode perméttant d'ajouter une news
     * @param $news News La news à ajouter
     * @return void
     */
    abstract protected function add(News $news);
    /**
     * Méthode permettant d'enregistrer une news 
     * @param $news News La news à enregistrer
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(News $news)
    {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        } else {
            throw new \RuntimeException('La news doit être validé pour être enregistrée');
        }
    }

    /**
     * Méthode retournant une liste de news demandée
     * @param $debut int La première news à sélectionner
     * @param $limite int Le nombre de news à sélectionner
     * @return array La liste des news. Chaque entrée est une instance de News.
     */
    abstract public function getList($debut = -1, $limite = -1);

    /**
     * Méthode retournant une news précise.
     * @param $id int L'identifiant de la news à récupérer
     * @return News La news demandée
     */
    abstract public function getUnique($id);

    /**
     * Méthode retournant le nombre de news total
     * @return int
     */
    abstract public function count();
}
