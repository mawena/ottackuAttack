<?php
namespace Library;
class PDOFactory{
    public static function getMysqlConnexion($host = "sql312.epizy.com", $port = "3306", $dbname = 'epiz_26890009_otakuattack', $user = 'epiz_26890009', $password='bT5zRJ90KeO1yrs'){    //Retourne une connexion à la bdd
        $db_PDO = new \PDO('mysql:host='. $host .';port='. $port .';dbname='.$dbname, $user, $password);
        $db_PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db_PDO;
    }
}