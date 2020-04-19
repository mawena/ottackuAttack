<?php

namespace Applications\Backend\Modules\Connexion;

class ConnexionController extends \Library\BackController
{
    /**
     * Fonction exécuté pour l'index de connexion
     * @return void
     */
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', "Connexion");
        $admins = $this->app->config()->getAdminAll();
        if ($request->postExists('login')) {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if (isset($admins[$login]) && $password == $admins[$login]) {
                $this->app->user()->setFlash('Connexion réussi');
                $this->app->user()->setAuthenticated(true);
                $this->app->httpReponse()->redirect('/admin/News');
            } else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect');
            }
        }
    }
}
