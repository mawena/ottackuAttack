<?php

namespace Library\Models;

use \Library\Entities\Comment;

class CommentsManager_PDO extends CommentsManager
{
    public function delete(int $id, $objet = "News")
    {
        $this->dao->exec('DELETE FROM ' . $objet . '_comments WHERE id = ' . (int) $id);
    }
    public function get($id, $objet = "News")
    {
        $commentArray = ($this->dao->query('SELECT id, elementId, auteur, contenu FROM ' . $objet . '_comments WHERE id =' . (int) $id))->fetch();
        return ($commentArray) ? new Comment($commentArray) : null;
    }
    protected function modify(Comment $comment, $objet = "News")
    {
        $q = $this->dao->prepare("UPDATE " . $objet . "_comments set auteur = :auteur, contenu = :contenu WHERE id = :id");
        $q->bindValue(":auteur", $comment->auteur());
        $q->bindValue(":contenu", $comment->contenu());
        $q->bindValue(":id", $comment->id(), \PDO::PARAM_INT);
        $q->execute();
    }
    protected function add(Comment $comment, $objet = "News")
    {
        $q = $this->dao->prepare("INSERT INTO " . $objet . "_comments set elementId = :elementId, auteur = :auteur, contenu = :contenu, date = NOW()");
        $q->bindValue(":elementId", $comment->elementId(), \PDO::PARAM_INT);
        $q->bindValue(":auteur", $comment->auteur());
        $q->bindValue(":contenu", $comment->contenu());
        $q->execute();
        $comment->setId($this->dao->lastInsertId());
    }
    public function getListOf($elementId, $objet = "News")
    {
        if (!is_int($elementId)) {
            throw new \RuntimeException("L'identifiant de l'objet doit être un nombre entier valide");
        }
        $q = $this->dao->prepare("SELECT id, elementId, auteur, contenu, date FROM " . $objet . "_comments WHERE elementId = :elementId");
        $q->bindValue(":elementId", $elementId, \PDO::PARAM_INT);
        $q->execute();
        foreach ($q->fetchAll() as $comment) {
            $comments[] = new \Library\Entities\Comment($comment);
        }   //Remplissage du tableau de commentaires
        if (isset($comments)) {
            foreach ($comments as $comment) {
                $comment->setDate(new \DateTime($comment->date()));
            }
            return $comments;
        } else {
            return false;
        }
    }
}
