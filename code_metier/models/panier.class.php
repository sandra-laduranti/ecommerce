<?php

class Panier {
	
	public function __construct(){
		if (!isset($_SESSION['panier']))
		{
			$_SESSION['panier'] = array(); /* initialisation du panier */
			$_SESSION['panier']['id_article'] = array();
			$_SESSION['panier']['qte'] = array();
		}
	}

	public function addpanier ($id,$qte) {
		if (array_search($id, $_SESSION['panier']['id_article']) === false)
		{
			array_push($_SESSION['panier']['id_article'],$id); 
			array_push($_SESSION['panier']['qte'],$qte); 
		}
	}

	public function modifpanier ($numproduit,$qte){ 
		$key = array_search($numproduit, $_SESSION['panier']['id_article']);
		$_SESSION['panier']['qte'][$key] = $qte; 
	}

	public function erasepanier ($numproduit){
		$key = array_search($numproduit, $_SESSION['panier']['id_article']);
		array_splice($_SESSION['panier']['id_article'], $key, 1);
		array_splice($_SESSION['panier']['qte'], $key, 1);
	}


	public function getpanier () {
		if (count($_SESSION['panier']['id_article']) == 0 )
		{
			return NULL;
		}
		else {
			$alcool = new Alcool();
			$tabalcool = $alcool->panierAlcools($_SESSION['panier']['id_article']);
			$i = 0;
			foreach ($tabalcool as $elem){
				$id = $elem['Numero_produit'];
				$key = array_search($id, $_SESSION['panier']['id_article']);
				$tabalcool[$i]['qte'] = $_SESSION['panier']['qte'][$key];
				$i++;
			}
			return $tabalcool;
		}
	}
}