<?php
namespace Library\Models;
class VideosManager_PDO extends VideosManager{
    public function getList($debut = -1, $limite = -1, $name = "*"){
        if(!is_string($name)){throw new \RuntimeException("Le nom de Video doit être une chaîne de caractère valide");}
        $sql = "SELECT id, nom, extention, artiste, dateAjout, description FROM Videos";
        $sql .= ($name == "*") ? "" : " WHERE nom REGEXP \"".$name."\"";
        $sql .= " ORDER BY id DESC";

        //Vérification de l'intégrité des paramètres fournis et finition de la requête sql
        ($debut != -1 || $limite != -1) ? $sql .= " LIMIT ".(int)$limite." OFFSET ".(int)$debut : NULL;
        $requete = $this->dao->query($sql);
        foreach($requete->fetchAll() as $Video){ $listeVideos[] = new \Library\Entities\Video($Video);}
        if(empty($listeVideos)){
            return false;
        }
        foreach($listeVideos as $Video){
            $Video->setDateAjout(new \DateTime($Video->dateAjout()));
        }
        $requete->closeCursor();
        return $listeVideos;
    }
    public function getUnique($id){
        $requete = $this->dao->query("SELECT id, nom, extention, artiste, dateAjout, description FROM Videos WHERE id = ".(int) $id);
        $VideosArray = $requete->fetch();
        if(!$VideosArray){
            return $VideosArray;
        }
        $Video = new \Library\Entities\Video($VideosArray);
        ($Video) ? $Video->setDateAjout(new \DateTime($Video->dateAjout())) : null;
        return $Video;
    }
    function count($regex = "*"){
            if($regex == "*" || $regex == null){
                $req = $this->dao->query('SELECT COUNT(*) AS nbVideos FROM Videos');
            }
            else{
                $req = $this->dao->query('SELECT COUNT(*) AS nbVideos FROM Videos WHERE nom REGEXP "'.$regex.'"'); //On récupère les logiciels correspondantes
            }
            $nbrVideos = $req->fetch();
            $req->closeCursor();
            
            return (int) $nbrVideos['nbVideos'];
    }
}