<?php

require_once 'code_metier/views/view.class.php';

class ctrlAccueil {

	public function welcome () {
		$locView = new View ("Accueil");
		$locView->compute();
	}
}