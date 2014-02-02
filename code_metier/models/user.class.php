<?php

require_once 'code_metier/DAL/DAL.class.php';

class User extends DAL {
	

	public function connexion ($mail, $password) {
		$locSQL = 'SELECT * FROM user WHERE Mail = ? AND Password = ?';
		$locRes = $this->doRequest($locSQL,array($mail, sha1($password)));
		if ($locRes != NULL){
			$_SESSION['user']['id'] = $locRes[0]['ID_u'];
		}
		return $locRes;
	}

	public function compte () {
		$id = $_SESSION['user']['id'];
		$locSQL = 'SELECT * FROM user WHERE ID_u = ? ';
		$locRes = $this->doRequest($locSQL,array($id));
		return $locRes;
	}

	public function savepanier ($panier){
		$id = $_SESSION['user']['id'];
		$locSQL = 'INSERT INTO commandes (id_user,date,commande) VALUES (?,CURRENT_TIMESTAMP,?)';
		$this->doInsert($locSQL, array($_SESSION['user']['id'],$panier['panier']));	
		foreach ($_SESSION['panier']['id_article'] as $key => $val){
			$locSQL = 'SELECT Stock FROM alcool WHERE Numero_produit = ?';
			$locRes = $this->doRequest($locSQL, array($val));
			$locIns = 'UPDATE alcool SET Stock=? WHERE Numero_produit=?';
			$this->doInsert($locIns, array($locRes[0]['Stock']-$_SESSION['panier']['qte'][$key], $val));
		}
		unset($_SESSION['panier']);
	}

	public function  historique (){
		$id = $_SESSION['user']['id'];
		$locID = array();
		$locSQL = 'SELECT * FROM commandes WHERE id_user = ?';
		$locRes = $this->doRequest($locSQL, array($id));

		$i = 0;
		while (isset($locRes[$i])){
			$locRes[$i]['decode'] = json_decode($locRes[$i]['Commande'], true);
			$i++;
		}

		foreach ($locRes as $commandeKey => $commandeVal) {
			foreach ($commandeVal['decode'] as $decodKey => $decodVal) {
				$locAlcool = new Alcool();
				$locAlc = $locAlcool->panierAlcools(array($decodVal['id']));
				$locRes[$commandeKey]['decode'][$decodKey] = array_merge($decodVal, $locAlc[0]);
			}
		}

		return $locRes;
	}


	public function inscription ($civilite, $nom, $prenom, $naissance, $adresse, $postal, $ville, $mail, $mdp) {
			$locSQL = 'SELECT * FROM user WHERE Mail = ?';
			$locRes = $this->doRequest($locSQL,array($mail));
			if ($locRes == NULL){
				$locIns = 'INSERT INTO user (Civ, Nom, Prenom, Datenaissance, Dateinscription, Adresse, CodePostal, Ville, Mail, Password, root) VALUES (?,?,?,?, CURRENT_TIMESTAMP,?,?,?,?,?,?)';
				$this->doInsert($locIns, array($civilite, $nom, $prenom, $naissance, $adresse, $postal, $ville, $mail, sha1($mdp), 0));
			}
			else {
				return false;
			}
			$locSQL = 'SELECT ID_u FROM user WHERE Mail = ?';
			$locRes = $this->doRequest($locSQL,array($mail));
			$_SESSION['user']['id'] = $locRes[0]['ID_u'];
			return $locRes;
	}

	public function modification ($nom, $adresse, $postal, $ville, $mail, $mdp) {
			$id = $_SESSION['user']['id'];
			$locSQL = 'SELECT * FROM user WHERE ID_u = ? ';
			$locRes = $this->doRequest($locSQL,array($id));
			$locIns = 'UPDATE user SET Nom=?, Adresse=?, CodePostal=?, Ville=?, Mail=?, Password=? WHERE ID_u=?';
			$this->doInsert($locIns, array($nom, $adresse, $postal, $ville, $mail, sha1($mdp), $id));
	}
}