<?php

////////////////////////////////////////
//          CONFIGURATION             //
////////////////////////////////////////
class Config {

  //  Les params entrées dans config.ini
  //  Utilisation en Singleton
  private static $_parametres;

  //  TODO : Mettre en constantes / enum
  //    les params possibles

  /**
  * Override constructeur, chargement de la conf
  *   au demarrage
  */
  public function __construct() {
    self::getParam();
  }

  /**
  * get un paramètre de la config
  * @param string $parParam le parametre voulu
  * @param string $parDefault la valeur par défaut (null par défaut)
  * @return var la valeur du paramètre demandé
  */
  public static function get($parParam, $parDefault = null) {
    if (isset(self::getParam()[$parParam])) {
      $locRes = self::getParam()[$parParam];
    }
    else {
      $locRes = $parDefault;
    }

    return $locRes;
  }

  /**
  * Parse & charge la config
  * /!\ A rappeler pour rafraichir la conf /!\
  * @return array tableau de la conf
  */
  private static function getParam() {
    if (self::$_parametres == null) {
      $locConfig = "config.ini";
      if (!file_exists($locConfig)) {
        throw new Exception("Pas de fichier de conf");
      }
      else {
        self::$_parametres = parse_ini_file($locConfig);
      }
    }
    
    return self::$_parametres;
  }
}

?>