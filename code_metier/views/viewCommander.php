<?php $this->_title = "Commander" ?>

<p> Merci pour votre commande </p></br></br>
<p> Détail de votre commande: </br></p>

<?php 
	$prix = 0;
	$json = array();
	foreach ($panier as $product){ 
   		echo '<p>' . $product['Type'] .' ' . $product['Detail'] .' '. $product['Marque'] .' volume: ' . $product['Volume'] . ' quantité: ' . $product['qte'] . ' prix: ' . $product['Prix'] . '€   prix total: ' . ($product['Prix'] * $product['qte']) . '€ </p>' ; 
		$prix += ($product['Prix'] * $product['qte']); 
		array_push($json,array('id'=>$product['Numero_produit'],'qte'=>$product['qte']));
 	} 
 echo '<p> Prix total= ' . $prix . '€ </p></br>';


echo '<p> A livrer chez: </p>';
echo '<p>' . $user['Civ'] . ' ' . $user['Prenom'] . ' ' . $user['Nom'] . '</p>';
echo '<p>' . $user['Adresse'] . '</p>';
echo '<p>' . $user['CodePostal'] . '</p>';
echo '<p>' . $user['Ville'] . '</p>';

?>

<form action="/alcool_minimvc/panier/valider" method="POST">
	<INPUT type=hidden name=panier value='<?php echo json_encode($json); ?>' >
    <p><input type="submit" value="Valider" /></p>
</form>