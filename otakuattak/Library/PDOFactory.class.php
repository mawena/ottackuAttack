<?php
namespace Library;
class PDOFactory{
    public static function getMysqlConnexion($dbname = "OtakuAttack"){    //Retourne une connexion à la bdd
        $db_PDO = new \PDO('mysql:host=localhost:3306;dbname='.$dbname, 'pim', 'licdovic');
        $db_PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db_PDO;
    }
}