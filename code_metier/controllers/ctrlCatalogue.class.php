<?php

require_once 'code_metier/models/alcool.class.php';
require_once 'code_metier/views/view.class.php';

class ctrlCatalogue {

	private $_alcools;

	public function __construct() {
		$this->_alcools = new Alcool();
	}

	public function show ($parParams) {
		$locType = isset($parParams['alcooltypes']) ? $parParams['alcooltypes'] : "tout";
		$locContenant = isset($parParams['contenant']) ? $parParams['contenant'] : "tout";
		$locPrix = isset($parParams['alcoolprix']) ? $parParams['alcoolprix'] : 10000;

		$locList = $this->_alcools->getAlcools($locType,
			$locContenant,
			$locPrix
		);
		$locView = new View ("Catalogue");
		$locView->compute(
			array('donnees' => $locList)
		);
	}

	public function supprimer ($parParams) {
		$this->_alcools->supprimerAlcool($parParams['numproduit']);
		header('Location: ../catalogue');
	}

	public function reappro ($parParams) {
		var_dump($parParams);
		$this->_alcools->approvisionnerAlcool($parParams['numproduit'],$parParams['Stock']); 
		header('Location: ../user/catalogue');
	}

	public function ajouter ($parParams) {
		var_dump($parParams);
		$this->_alcools->ajouterAlcool($parParams);	
		header('Location: ../user/compte');
	}
}

?>