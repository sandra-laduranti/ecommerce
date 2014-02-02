<?php $this->_title = "Historique" ?>

<?php

foreach ($panier as $paKey => $paVal) {
	$prix = 0;
	echo '<p> Commande n°' . $paVal['id_commande'] . ' le: ' . $paVal['date'] . '</p> Contenant : <ul>';
	foreach ($paVal['decode'] as $decKey => $decVal) {
		echo '<li>' . $decVal['Marque'] . ' ' . $decVal['Type'] . ' ' . $decVal['Detail'] . ' ' . $decVal['Conteneur'] . ' ' . $decVal['Volume']  . 'Cl     Prix unitaire:' . $decVal['Prix'] .'€    quantité: ' . $decVal['qte'] . ' Prix total:' . ($decVal['Prix'] * $decVal['qte']) . '€ </li>';
		$prix += ($decVal['Prix'] * $decVal['qte']);
	}
	echo '</ul>';
	echo '<p> prix total: ' . $prix . '€ </p>';
	echo '<p> ___________________________ </p>';
}

?>