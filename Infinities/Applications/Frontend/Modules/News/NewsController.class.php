<?php

namespace Applications\Frontend\Modules\News;

class NewsController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {

        //On récupère la configuration
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

        //On ajoute une définition pour le titre.

        $this->page->addVar('title', 'Liste des ' . $nombreNews . ' dernières news');

        //On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');
        $listesNews = $manager->getList(0, $nombreNews);
        foreach ($listesNews as $news) {
            if (strlen($news->contenu()) > $nombreCaracteres) {   //Si le contenu des news est supérieur au nombre de caractères maximum
                // On modifie le contenu pour être en concordance avec les paramètres
                $debut = substr($news->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $news->setContenu($debut);
            }
        }
        $this->page->addVar('listeNews', $listesNews); //On ajoute la variable $listeNews à la page

    }
    public function executeShow(\Library\HTTPRequest $request)
    {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));  //On récupère la news conrespondante à la requêtte
        if (empty($news)) {   //Si la news n'est pas dans la base de donnée on redirige vers une erreur 404
            $this->app->httpReponse()->redirect404();
        }
        //On envoie les données à la base de donné
        $this->page->addVar('title', "news : " . $news->titre());
        $this->page->addVar('element', $news);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id())); //On récupère les commentaires sur la news
    }
    public function executeInsertComment(\Library\HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $comment = new \Library\Entities\Comment(array(
                'elementId' => $request->getData('news'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu')
            ));
        } else {
            $comment = new \Library\Entities\Comment;
        }

        $formBuilder = new \Library\CommentFormBuilder($comment);   //Création du constructeur de formulaire
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Comments'), $request);


        if ($formHandler->process()) {
            $this->app->user()->setFlash("Le commentaire a bien été enregistré, merci !");
            $this->app->httpReponse()->redirect('News-' . $request->getData('news') . "#" . $comment['id']);
        }
        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', "Ajout d'un commentaire");
    }
}
