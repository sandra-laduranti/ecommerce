<?php $this->_title = "Compte" ?>


<?php if ($donnees[0]['root'] == 0)
	  {
	 	$adresse = $donnees[0]['Adresse'];
		$adresse=str_replace(' ','',$adresse);
		$nom = $donnees[0]['Nom'];
		$nom =str_replace(' ','',$nom);
		echo "Bonjour, " . $donnees[0]['Prenom'] . " bienvenue dans l'interface utilisateur.";
?>

		<p> Pour effectuer un achat vous pouvez vous rendre dans la section 'Panier' afin de valider celui-ci. </p>
		</br>

		<p> Vous avez la possibilité de modifier vos informations: </p>
		<form id="formmodif" action="/alcool_minimvc/user/modification" method="POST">
			<p> <input value=<?php echo $nom ?> name="nom" type="text" size="40" maxlength="20"/> </p>
			<p> <input value=<?php echo $adresse ?> name="adresse" type="text" size="40" maxlength="40"/> </p>
			<p> <input value=<?php echo $donnees[0]['CodePostal']?> name="postal" type="text" maxlength="5" minlength="5" size='40'/> </p>
			<p> <input value=<?php echo $donnees[0]['Ville']?> name="ville" type="text" size="40" maxlength="20"/> </p>
			<p> <input value=<?php echo $donnees[0]['Mail']?> id="mail" name="mail" type="text" size="40" maxlength="40"/><span id='errormail'></span> </p>
			<p> <input placeholder="Password" id="mdp" name="mdp" type="password" size="40" maxlength="20"/> </p>
			<p> <input placeholder="Confirmation pswd" id="confirmation" name="confirmation" type="password" size="40" maxlength="20"/> <span id='errorpswd'></span></p>
			<p id="globalerror"> </p>
			<INPUT id="submit" type="submit" value="Modifier" />
		</form>
		</br></br>

		<form action="/alcool_minimvc/user/historique" method="POST">
			<p>Vous pouvez consulter l'historique de vos commandes ici: <input id="historique" type="submit" value="Historique de mes commandes" /></p>
		</form>
<?php } 

	else
	{
?>
		<p> Bonjour, bienvenue dans l'interface d'administration. </p>
		<p> Vous avez la possibilité d'ajouter un produit: </p>

		<form id="formajout" action="/alcool_minimvc/catalogue/ajouter" method="POST">
			<p> <input placeholder="Marque" name="marque" type="text" size="40" maxlength="20"/> </p>
			<select name="type">
							<option value=Biere>Bière</option>
							<option value=Whisky>Whisky</option>
							<option value=Champagne>Champagne</option>
							<option value=Vodka>Vodka</option>
							<option value=Vin>Vin</option>
			</select> </p>
			<p> <input placeholder="Detail" name="detail" type="text" size="40" /> </p>
			<select name="conteneur">
							<option value=bouteille>Bouteille</option>
							<option value=canette>Canette</option>
			</select> </p>
			<p> <input placeholder="Volume en Cl"  id="volume" name="volume" type="text" size="40" maxlength="10"/> </p> <span id='errorvolume'></span></p>
			<p> <input placeholder="Prix" id="prix" name="prix" type="text" size="40" maxlength="10"/> </p> <span id='errorprix'></span></p>
			<p> <input placeholder="Stock" name="stock" id="stock" type="text" size="40" maxlength="10"/> </p> <span id='errorstock'></span></p>
			<p><TEXTAREA placeholder="Commentaire" name="commentaire" rows="4" cols="35"></TEXTAREA></p>
			<p> <input placeholder="Degré de l'alcool" id="degre" name="degrealcool" type="text" size="40" maxlength="40"/> </p> <span id='errordegre'></span></p>
			<p id="errorajout"> </p>
			<INPUT id="ajouter" type="submit" value="Ajouter Produit" />
		</form>

<?php
	}
?>

</br></br>
<form action="/alcool_minimvc/user/deconnexion" method="POST">
	<p><input id="disconnect" type="submit" value="Disconnect" /></p>
</form>

<script type="text/javascript" src="/alcool_minimvc/scripts/formulairemodif.js"></script>
<script type="text/javascript" src="/alcool_minimvc/scripts/formulairealcool.js"></script>

