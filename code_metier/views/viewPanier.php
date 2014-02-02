<?php $this->_title = "Panier" ?>

<p>
<?php 
$prix = 0;
if ($element == NULL){
    echo 'Votre panier est vide';
}
else {
	foreach ($element as $product){ ?>
	<p> <?php echo $product['Type'] .' ' . $product['Detail'] .' '. $product['Marque'] .' volume: ' . $product['Volume'] . 'prix: ' . $product['Prix'] . '€ quantité: ' . $product['qte']; ?> 
        <form action=panier/modifpanier method=post>
             <INPUT type=hidden name=numproduit value=<?php echo $product['Numero_produit'];  ?> >
            <select name="quantite">
                <?php
                    $max = ($product['Stock'] >= 20)? 20 : $product['Stock'];
                    $i = 1;
                    while ($i <= $max) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                        $i++;
                } ?>
            </select>
             <INPUT id="change" type="submit" value="Changer la quantité" />
        </form>
        <form action=panier/erasepanier method=post>
            <INPUT type=hidden name=numproduit value=<?php echo $product['Numero_produit'];  ?> >
            <INPUT id="remove" type="submit" value="Retirer du panier" />
        </form></p>
    <?php   $prix += ($product['Prix'] * $product['qte']);

	   }
    } 
    if ($prix > 0){
        echo 'Prix total: ' . $prix .'€'; ?>
        <form action="/alcool_minimvc/panier/commander" method="POST">
            <p><input id="commande" type="submit" value="Commander" /></p>
        </form>
  <?php  } ?>
