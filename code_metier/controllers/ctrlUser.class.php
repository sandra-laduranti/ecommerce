<?php

require_once 'code_metier/models/user.class.php';
require_once 'code_metier/views/view.class.php';
require_once 'code_metier/models/alcool.class.php';

class ctrlUser {

	private $_user;

	public function __construct() {
		$this->_user = new User();
	}

    public function show () {
        if (!empty($_SESSION['user'])){
			header('Location: /alcool_minimvc/user/compte');
		}
		else{
			header('Location: /alcool_minimvc/user/inscription ');
		}
    }

    public function connexion ($parParams) {
    	$locRes = $this->_user->connexion($parParams['mail'], $parParams['mdp']);
    	if ($locRes == NULL){
    		header('Location: /alcool_minimvc/user/inscription');
    	}
    	else{
			$locCompte = $this->_user->compte();
    		$locView = new View ("Compte");
       		$locView->compute(
			array('donnees' => $locCompte)
		);
    	}
    }

     public function deconnexion () {
    	unset($_SESSION['user']);
    	$locView = new View ("User");
       	$locView->compute();
    }


    public function compte () {
    	$locRes = $this->_user->compte();
    	$locView = new View ("Compte");
       	$locView->compute(
			array('donnees' => $locRes)
		);
    }

 	public function historique () {
     	$locRes = $this->_user->historique();
     	$locView = new View ("Historique");
       	$locView->compute(
			array('panier' => $locRes)
		);
    }

    public function modification ($parParams) {
    	$this->_user->modification($parParams['nom'], $parParams['adresse'], $parParams['postal'], $parParams['ville'], $parParams['mail'], $parParams['mdp']);
    	$locRes = $this->_user->compte();
    	?>
			<script type="text/javascript"> alert('Votre compte a été modifié'); </script>
		<?php	
    	$locView = new View ("Compte");
       	$locView->compute(
			array('donnees' => $locRes)
		);
    }

    public function inscription ($parParams) {
    	if (isset($parParams["mdp"])){
    		if ((strlen($parParams["mdp"]) > 0) && (strlen($parParams["mail"]) > 0)){
		    	if ((date("Y") - $parParams['naissance']) < 18){
		    		echo 'Vous n avez pas l âge légal pour acheter de l alcool.';
		    	}
		    	else{
					$locRes = $this->_user->inscription($parParams['civilite'], $parParams['nom'], $parParams['prenom'], $parParams['naissance'], $parParams['adresse'], $parParams['postal'], $parParams['ville'], $parParams['mail'],$parParams['mdp']);
					if ($locRes != false){
							$locRes = $this->_user->compte();
							$locView = new View ("Compte");
       						$locView->compute(
								array('donnees' => $locRes)
							);	
					}
					else{ ?>
						<script type="text/javascript"> alert('ce mail est déjà présent dans la base'); </script>
					<?php	$locView = new View ("User");
	       	   			 $locView->compute();
					}
				}
			}
			else {
				$locView = new View ("User");
	       	    $locView->compute();
			}
		}
		else {
			$locView = new View ("User");
       	    $locView->compute();
		}
    }
}

?>