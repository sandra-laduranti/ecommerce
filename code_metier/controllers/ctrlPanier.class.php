<?php

require_once 'code_metier/views/view.class.php';
require_once 'code_metier/models/panier.class.php';
require_once 'code_metier/models/user.class.php';

class ctrlPanier {

	private $_panier;

	public function __construct() {
		$this->_panier = new Panier();
	}

    public function show ($elem) {
        $locView = new View ("Panier");
        $locView->compute(array('element'=>$this->_panier->getpanier()));
    }

    public function addpanier ($elem) {
    	$this->_panier->addpanier($elem["numproduit"], $elem["qtealcool"]);
		header('Location: ../catalogue');
    }

    public function modifpanier ($elem) {
        $this->_panier->modifpanier($elem["numproduit"], $elem["quantite"]);
        header('Location: ../panier');
    }

    public function commander () {
        if (!isset($_SESSION['user']['id'])){
            $locView = new View ("User");
            $locView->compute();
        }
        else {
            $arraypanier = $this->_panier->getpanier();
            $user = new User ();
            $arrayuser = $user->compte();
            $locView = new View ("Commander");
            $locView->compute(array('panier'=>$arraypanier,'user'=>$arrayuser[0]));
        }
    }

    public function valider ($elem) {
        $user = new User ();
        $user->savepanier($elem);
        $locRes = $user->historique();
        $locView = new View ("Historique");
        $locView->compute(
            array('panier' => $locRes)
        );
    }

    public function erasepanier ($elem) {
        $this->_panier->erasepanier($elem["numproduit"]);
        header('Location: ../panier');
    }
}
