<?php

require_once 'code_metier/DAL/DAL.class.php';

class Alcool extends DAL {

	public function getAlcools ($parType = 'tout', $parContenant = 'tout', $parPrix = 10000) {
		
		$min = 0;
		$max = $parPrix;
		if ($max==35) { $min = 0; }
		if ($max==70) { $min = 35; }
		if ($max==100) { $min= 70;}
		if ($max==1000) {$min=100;}
		if ($max==10000) {$min=0;}

		if ($parType == "tout" && $parContenant == "tout") {
			$locSQL = 'SELECT * FROM alcool WHERE Prix > '. $min .' AND Prix < '. $max;
			$locRes = $this->doRequest($locSQL);
		}
		else if ($parType == "tout" && $parContenant != "tout") {
			$locSQL = 'SELECT * FROM alcool WHERE Conteneur = ? AND Prix > '. $min .' AND Prix < '. $max;
			$locRes = $this->doRequest($locSQL, array($parContenant));
		}
		else if ($parType != "tout" && $parContenant == "tout") {
			$locSQL = 'SELECT * FROM alcool WHERE Type = ? AND Prix > '. $min .' AND Prix < '. $max;
			$locRes = $this->doRequest($locSQL, array($parType));
		}
		else {
			$locSQL = 'SELECT * FROM alcool WHERE Type = ? AND  Conteneur = ? AND Prix > '. $min .' AND Prix < '. $max;
			$locRes = $this->doRequest($locSQL, array($parType, $parContenant));
		}

		if (isset($_SESSION['user']['id'])){
			$key = count($locRes)-1;	
			$locSQL = 'SELECT ID_u,Mail,Password,Root FROM user WHERE ID_u = ?';
			$locUser = $this->doRequest($locSQL,array($_SESSION['user']['id']));
			$locRes[$key][count($locRes[$key])] = $locUser;
		}
		return $locRes;
	}

	public function panierAlcools ($parid){
		$identif = rtrim(str_repeat('?, ', count($parid)), ', ');
		$locSQL = 'SELECT Marque, Type, Detail,Conteneur,Volume,Prix, Degre_alcool, Numero_produit, Stock, image FROM alcool WHERE Numero_produit IN ('.$identif.')';
		$locRes = $this->doRequest($locSQL, $parid);
		return $locRes;
	}

	public function supprimerAlcool ($parid){
		$locSQL = 'DELETE FROM alcool WHERE Numero_produit = ?';
		$this->doInsert($locSQL, array($parid));
	}


	public function approvisionnerAlcool ($parid,$parqte){
		$locSQL = 'SELECT Stock FROM alcool WHERE Numero_produit = ?';
		$locRes = $this->doRequest($locSQL, array($parid));
		$locIns = 'UPDATE alcool SET Stock=? WHERE Numero_produit=?';
		$this->doInsert($locIns, array($locRes[0]['Stock']-$parqte, $parid));
	}

	public function ajouterAlcool ($parParam){
		$locSQL = 'SELECT * FROM alcool WHERE Marque = ? AND Type = ? AND Detail = ? AND Conteneur = ? AND Volume = ? AND Degre_alcool = ?';
		$locRes = $this->doRequest($locSQL,array($parParam['marque'],$parParam['type'],$parParam['detail'],$parParam['conteneur'],$parParam['volume'],$parParam['degrealcool']));

		if ($locRes == null){
			$locSQL = 'INSERT INTO alcool (Marque,Type,Detail,Conteneur,Volume,Prix,Stock,Commentaire,Promotion,Date_insertion,Degre_alcool) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(),?)';
			$this->doInsert($locSQL, array($parParam['marque'],$parParam['type'],$parParam['detail'],$parParam['conteneur'],$parParam['volume'],$parParam['prix'],$parParam['stock'],$parParam['commentaire'],0,$parParam['degrealcool']));	
		}
	}
}