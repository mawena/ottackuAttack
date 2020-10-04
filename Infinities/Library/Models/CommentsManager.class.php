<?php

namespace Library\Models;

use \Library\Entities\Comment;

abstract class CommentsManager extends \Library\Manager
{
    /**
     * Méthode permettant de suprimmer un commentaire
     * @param $id int l'identifiant du commentaire
     * @return void
     */
    abstract public function delete(int $id);

    /**
     * Méthode retournant un commentaire
     * @param $id int l'identifiant de news
     * @return \Library\Entities\News
     */
    abstract public function get(int $id);

    /**
     * Méthode permétant de mettre à jour un commentaire
     * @param $comment le commentaire à modifier
     * @return void
     */
    abstract protected function modify(Comment $comment);

    /**
     * Méthode permétant d'ajouter un commentaire
     * @param $comment le commentaire à ajouter
     * @return void
     */
    abstract protected function add(Comment $comment);

    /**
     * Méthode permétant d'enregistrer un commentaire
     * @param $comment le commentaire à enregistrer
     * @return void
     */
    public function save(Comment $comment, $objet = "News")
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment, $objet) : $this->modify($comment, $objet);
        } else {
            throw new \RuntimeException("Le commentaire doit être validé pour être enregistré");
        }
    }

    /**
     * Méthode permétant de récupérer une liste de commentaires
     * @param $news l'indentifiant de la news dont on veut récupérer les commentaires
     * @return array
     */
    abstract protected function getListOf($news);
}
