<?php

require_once 'code_metier/controllers/ctrlAccueil.class.php';
require_once 'code_metier/controllers/ctrlCatalogue.class.php';
require_once 'code_metier/controllers/ctrlPanier.class.php';
require_once 'code_metier/controllers/ctrlUser.class.php';
require_once 'code_metier/views/view.class.php';

class Routeur {

  private $_ctrlAccueil;
  private $_ctrlCatalogue;
  private $_ctrlUser;
  private $_ctrlPanier;

  public function __construct() {
    $this->_ctrlAccueil = new ctrlAccueil();
    $this->_ctrlCatalogue = new ctrlCatalogue();
    $this->_ctrlUser = new ctrlUser();
    $this->_ctrlPanier = new ctrlPanier();
  }

  public function routing() {
    try {

      if (isset($_GET['page']) && $_GET['page'] != "") {
        $locPage = strtolower($_GET['page']);
        switch ($locPage) {
          case 'accueil':
            $this->_ctrlAccueil->welcome();
            break;
          case 'catalogue':
                if ($_GET['action'] == 'supprimer'){
                      $this->_ctrlCatalogue->supprimer(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'ajouter'){
                      $this->_ctrlCatalogue->ajouter(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'reappro'){
                      $this->_ctrlCatalogue->reappro(array_merge($_GET, $_POST));
                }
                else{
                  $this->_ctrlCatalogue->show(array_merge($_GET, $_POST));
                }
            break;
          case 'user':
                if ($_GET['action'] == 'inscription'){
                  $this->_ctrlUser->inscription(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'connexion'){
                   $this->_ctrlUser->connexion(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'modification'){
                   $this->_ctrlUser->modification(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'compte'){
                  $this->_ctrlUser->compte();
                }
                 elseif ($_GET['action'] == 'deconnexion'){
                  $this->_ctrlUser->deconnexion();
                }
                 elseif ($_GET['action'] == 'historique'){
                  $this->_ctrlUser->historique();
                }
                else {
                  $this->_ctrlUser->show();
                }
          break;
          case 'panier':
                if ($_GET['action'] == 'addpanier'){
                  $this->_ctrlPanier->addpanier(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'modifpanier'){
                  $this->_ctrlPanier->modifpanier(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'erasepanier'){
                  $this->_ctrlPanier->erasepanier(array_merge($_GET, $_POST));
                }
                elseif ($_GET['action'] == 'commander'){
                    if (count($_SESSION['panier']['id_article']) == 0){
                      $this->_ctrlPanier->show(array_merge($_GET,$_POST));
                    }
                    else{
                      $this->_ctrlPanier->commander();
                    }
                }
                elseif ($_GET['action'] == 'valider'){
                  $this->_ctrlPanier->valider(array_merge($_GET,$_POST));
                }
                else{
                  $this->_ctrlPanier->show(array_merge($_GET, $_POST));
                }
            break;
          default:
            throw new Exception("Page inconnue", 1);
            break;
        }
      }
      else {
        $this->_ctrlAccueil->welcome();
      }
    }
    catch (Exception $e) {
      $this->errorHandler($e->getMessage());
    }
  }

  private function errorHandler ($parMsg) {
    $locView = new View("Error");
    $locView->compute(array('errorMsg' => $parMsg));
  }
}

?>