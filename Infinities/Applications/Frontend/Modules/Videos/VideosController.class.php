<?php

namespace Applications\Frontend\Modules\Videos;

class VideosController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $nombreVideos = $this->app->config()->get('nombreVideos');
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        $nombrePagesMax = $this->app->config()->get('nombre_pages_max');
        $manager = $this->managers->getManagerOf('Videos');
        //On récupère les objets nécéssaires
        $listeVideos = array();

        if ($request->postExists('video') && $request->postData('video') == "") {   //Si la recherche est invalide
            $this->page->addVar('messageErreur', "Veuillez effectuer une recherche valide");
            unset($_POST['video']);
            unset($_SESSION['video']);
        }
        if (isset($_SESSION['video']) && $_SESSION['video'] == "") {  //Si la recherche était invalide
            $this->page->addVar('messageErreur', "Veuillez effectuer une recherche valide");
            unset($_SESSION['video']);
        }
        $request->postExists('video') ? $_SESSION['video'] = $request->postData('video') : null;   //Si on effectue une recherche
        if (isset($_SESSION['video']) && $manager->count($_SESSION['video']) != 0) {
            $listeVideos = $manager->getList($request->getExists('page') ? (((int) $request->getData('page')) - 1) * $nombreVideos : 0, $nombreVideos, $_SESSION['video']);    //On récupère les Videos
            $nb_resl =  (int) $manager->count($_SESSION['video']);    //On stocke le nombre de résultat
            $nb_page_total = (int) ceil($nb_resl / $nombreVideos);    //On calcule le nombre de page
            $this->page->addVar('nombre_resultats', $nb_resl);   //On ajoute le nombre de résultat à la vue
            ($nb_resl > $nombreVideos) ? $this->page->addVar('pagination', \Library\Pagination::getPagination($nb_page_total, (int) $nombrePagesMax, "Videos-p-", (int) $request->getData('page'))) : null;  //Si on n'a plus d'une page, on ajoute un sytème de pagination à la vue
            ((int) $request->getData('page') > $nb_page_total) ? $this->app->httpReponse()->redirect404() : null;
        }
        if (empty($listeVideos) && !$listeVideos) { //Si on n'effectue pas de recherche ou si on n'a pas de résultats
            $this->page->addVar('title', 'Liste des ' . $nombreVideos . ' dernièrs Videos ');
            $listeVideos = $manager->getList(0, $nombreVideos);
        }
        isset($_SESSION['video']) ? $this->page->addVar('nombre_resultats', $manager->count($_SESSION['video'])) : null;   //On ajoute le nombre de résultat à la vue
        $this->page->addVar('listeVideos', $listeVideos);
    }

    public function executeShow(\Library\HTTPRequest $request)
    {
        $video = $this->managers->getManagerOf('Videos')->getUnique($request->getData('id'));  //On récupère la videos conrespondante à la requêtte
        if (empty($video)) {   //Si le video n'est pas dans la base de donnée on redirige vers une erreur 404
            $this->app->httpReponse()->redirect404();
        }
        //On envoie les données à la base de donné
        $this->page->addVar('element', $video);
        $manager_comments = $this->managers->getManagerOf('Comments');
        if ($manager_comments->getListOf($video->id(), "Videos")) {
            $this->page->addVar('comments', $manager_comments->getListOf($video->id(), "Videos"));
        }
        // $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($video->id(), "Videos")); //On récupère les commentaires sur la videos
    }

    public function executeInsertComment(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', "Ajout d'un commentaire");
        if ($request->postExists('pseudo')) { //On Crée le commentaire si le pseudo est donné en post

            $comment = new \Library\Entities\Comment(array(
                'elementId' => $request->getData('video'),
                'auteur' => $request->postData('pseudo'),
                'contenu' => $request->postData('contenu')
            ));
            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment, "Videos");
                $this->app->user()->setFlash("Le commentaire a bien été ajouté, merci !");
                $this->app->httpReponse()->redirect('Videos-' . $request->getData('video'));
            } else {
                $this->page->addVar('erreurs', $comment->erreurs());
            }   //Si le commentaire est valide, on l'enregistre en bdd et on redirige vers la news, sinon on ajoute les erreurs à la page
            $this->page->addVar('comment', $comment);
        }
    }
}
