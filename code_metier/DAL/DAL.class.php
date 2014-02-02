<?php

require_once 'code_metier/configuration/config.class.php';

////////////////////////////////////////
//               DAL                  //
////////////////////////////////////////
//         Data Access Layer          //
////////////////////////////////////////

abstract class DAL {

    //  Accès à la base
    //  En Singleton pour ne pas le réinstancier à
    //      chaque fois
    private static $_bdd;

    /**
    * Override constructeur, chargement de la base
    *   au demarrage
    */
    public function __construct() {
        self::getBdd();
    }

    /**
     * Fait une requête préparée SQL
     * @param string $parSql requête SQL
     * @param array $parParams paramètres de la requête (default = null)
     * @return PDOStatement le(s) résultat(s)
     */
    protected function doRequest($parSql, $parParams = null) {
        if ($parParams == null) {
            $locRes = self::getBdd()->query($parSql);
        }
        else {
            $locRes = self::getBdd()->prepare($parSql);
            $locRes->execute($parParams);
        }

        return $locRes->fetchAll();
    }

/* l'insert ne renvoie pas de valeur on ne peut donc pas effectuer de fetch dessus */
     protected function doInsert($parSql, $parParams = null) {
        if ($parParams == null) {
            $locRes = self::getBdd()->query($parSql);
        }
        else {
            $locRes = self::getBdd()->prepare($parSql);
            $locRes->execute($parParams);
        }

        return;
    }


    /**
     * Fait pls requêtes préparées SQL
     * @param array $parSql requête SQL
     * @param array[array] $parParams paramètres de la requête (default = null)
     * @return array[PDOStatement] les résultats
     */
    protected function doManyRequests($parSql, $parParams = null) {
        $locRes = array();

        //  TODO si besoin

        return $locRes;
    }

    /**
     * Connexion à la base
     * @return PDO bdd
     */
    private static function getBdd() {
        if (self::$_bdd === null) {
            $locBdd = Config::get("bdd");
            $locLogin = Config::get("login");
            $locMdp = Config::get("mdp");
            self::$_bdd = new PDO($locBdd, $locLogin, $locMdp,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        return self::$_bdd;
    }

}

?>