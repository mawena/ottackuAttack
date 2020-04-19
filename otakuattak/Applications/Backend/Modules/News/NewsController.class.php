<?php

namespace Applications\Backend\Modules\News;

use Library\Config;
use \Library\HTTPRequest;
use \Library\Entities\Comment;

class NewsController extends \Library\BackController
{
    /**
     * Méthode appelée pour l'index des news du backend
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', "Gestion des news");
        $manager = $this->managers->getManagerOf('News');
        $this->page->addVar('listeNews', $manager->getList());
        $this->page->addVar('nombreNews', $manager->count());
    }
    /**
     * Méthode appelée pour insérer une news
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', "Ajout d'une news");
    }

    /**
     * Méthode appelée pour pour modifier une news
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', "Modification d'une news");
    }

    /**
     * Méthode appélé pour suprimer une news
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('News')->delete((int) $request->getData('id'));
        $this->app->user()->setFlash("La news a bien été suprimée !");
        // $this->setView('index');
        $this->app->httpReponse()->redirect(".");
    }

    /**
     * Méthode permettant de modifier un commentaire
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeUpdateComment(HTTPRequest $request)
    {
        if ($request->method() == "POST") {
            $comment = new Comment(array(
                'id' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu')
            ));
        } else {
            $comment = new Comment();
        }

        $formBuilder = new \Library\CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash("Le commentaire a bien été modifié");
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
            $this->app->httpReponse()->redirect("/News-" . $comment['elementId'] . "#" . $comment['id']);
        }

        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', "Modification d'un commentaire");
    }

    /**
     * Métode permettant de suprimer un commentaire
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function executeDeleteComment(HTTPRequest $request)
    {
        $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        $this->managers->getManagerOf('Comments')->delete((int) $request->getData('id'));
        $this->app->user()->setFlash("Le commentaire a bien été suprimée !");
        if ($_SESSION['module'] == 'News') {
            $this->app->httpReponse()->redirect("/News-" . $comment['elementId']);
        } elseif ($_SESSION['module'] == 'Videos') {
            $this->app->httpReponse()->redirect("/Videos-" . $comment['elementId']);
        }
    }

    /**
     * Méthode permétant de traiter un formulaire et d'enregistrer une news en BDD
     * @param $request \Library\HTTPRequest L'objet de traitement des requêtes
     * @return void
     */
    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == "POST") {
            $news = new \Library\Entities\News(array('auteur' => $request->postData('auteur'), 'titre' => $request->postData('titre'), 'contenu' => $request->postData('contenu')));

            //Si on veut effectuer une modification, l'identification de la news est transmise
            if ($request->getExists('id')) {
                $news->setId((int) $request->getData('id'));
            }
        } else {
            //L'identifiant de la news est transmise si on veut la modifier
            if ($request->getExists('id')) {
                $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            } else {
                $news = new \Library\Entities\News;
            }
        }
        $formBuilder = new \Library\NewsFormBuilder($news);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('News'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash($news->isNew() ? "La news a bien été ajoutée" : "La news a bien été modifié");
            $this->app->httpReponse()->redirect("/admin/");
        }
        $this->page->addVar('form', $form->createView());
    }
}
