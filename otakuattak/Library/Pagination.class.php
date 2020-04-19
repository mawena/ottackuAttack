<?php

namespace Library;

class Pagination extends \Library\ApplicationComponent
{

    /**
     * Méthode permettant de mettre en place un système de pagination
     * @param $nbrPage:int Le nombre de page totale 
     * @param $nbrLinksMax:int Le nombre maximum de lien à afficher
     * @param $link:String Le début du lien vers les pages
     * @param $page:int La page actuel
     * @return String
     */
    public static function getPagination(int $nbrPage = 1, int $nbrLinksMax = 1, String $link = "/", int $page = 1)
    {
        $pagination = "<div class='pagination'>";   //Création et mis au point de la variable contenant la pagination

        if ($nbrPage <= 1) {
            return "";
        } //S'il n'y a qu'une seule page on ne retourne pas de pagination
        if ($page < intdiv($nbrLinksMax, 2)) {  //Si la page actuel est inférieur à la moitié du nombre de lien maximum par défaut
            $debut = 1;
        } else {
            $debut = $page - floor($nbrLinksMax / 2);
            $debut = ($debut == 0) ? 1 : $debut;
        }
        foreach (range($debut, $debut + $nbrLinksMax - 1) as $comp) {  //On ajoute les liens en fonction du nombre de liens maximum
            if ($comp <= $debut + $nbrLinksMax - 1 && $comp > 0 && $comp <= $nbrPage) {
                $pagination .= "<a class='link-news-2 '" . (($comp == $page) ? "style='background: black;'" : "") . " href='" . $link . $comp . "'>" . $comp . "</a>";
            }
        }
        $pagination .= "</div>";
        return $pagination;
    }
}
