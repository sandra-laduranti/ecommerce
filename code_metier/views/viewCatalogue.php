<?php $this->_title = "Catalogue" ?>

<form action=catalogue method=post>
<p>Type : <select name="alcooltypes">
<option value=Biere>Bière</option>
<option value=Whisky>Whisky</option>
<option value=Vodka>Vodka</option>
<option value=Champagne>Champagne</option>
<option value=Vin>Vin</option>
<option value=tout>Tout</option>
</select>
Contenant : <select name="contenant">
<option value=canette>Canette</option>
<option value=bouteille>Bouteille</option>
<option value=tout>Tout</option>
</select>
Prix : <select name="alcoolprix">
<option value=35>de 0 à 35€</option>
<option value=70>de 35 à 70€</option>
<option value=100>de 70 à 100€</option>
<option value=1000>plus de 100€</option>
<option value=10000>Tout</option>
</select></p>
<p><input id="envoi" type="submit" value="envoi" />
<input id="retry" type="reset" value="remise à zéro" /></p>
</form>

<?php foreach ($donnees as $alcool): ?>
<div id= "boxe">
     <div id= "inboxe">
        <p>
        <img src = '<?php echo $alcool['image']; ?>' height=120 />
        <br /> <?php echo $alcool['Marque']; ?>
        <br /> <?php echo $alcool['Type']; ?> <?php echo $alcool['Detail']; ?>
        <br /> <?php echo $alcool['Conteneur']; ?> de <?php echo $alcool['Volume']; ?> Cl
        <br /> Prix: <?php echo $alcool['Prix']; ?> €
        <?php 
            if ($alcool['Stock'] > 5 )
                echo '   En stock';
            if ($alcool['Stock'] > 0 && $alcool['Stock'] <= 5 )
                echo '   Bientôt épuisé';
            if ($alcool['Stock'] <= 0 )
                echo '   Stock épuisé';
        ?>
        <form action=panier/addpanier method=post>
         <p>  <INPUT type=hidden name=numproduit value=<?php echo $alcool['Numero_produit'];  ?> >
            <INPUT type=hidden name=page value="catalogue" >
            <select name="qtealcool">
                <?php
                    $max = ($alcool['Stock'] >= 20)? 20 : $alcool['Stock'];
                    $i = 1;
                    while ($i <= $max) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                        $i++;
                } ?>
            </select>
            <INPUT id="addpanier" type="submit" <?php if ($alcool['Stock'] <= 0) echo 'disabled'; ?> value="ajouter au panier" /></p>
        </form>

       <?php $key=count($donnees)-1;
        if (isset($donnees[$key][(count($donnees[$key]) - 1)][0]['ID_u'])){
            if ($donnees[$key][(count($donnees[$key]) - 1)][0]['Root'] == 1){?>
                <form onsubmit= "return confirm('Voulez vous vraiment supprimer ce produit de la base? Attention cette action est irreversible')" action="/alcool_minimvc/catalogue/supprimer" method="POST">
                    <INPUT type=hidden name=numproduit value=<?php echo $alcool['Numero_produit'];  ?> >
                <p><input type="submit" value="Supprimer de la base" /></p>
                </form>

                <form action="/alcool_minimvc/catalogue/reappro" method="POST">
                    <INPUT type=hidden name=numproduit value=<?php echo $alcool['Numero_produit'];  ?> >
                    <p> Stock actuel: <?php echo $alcool['Stock']; ?> Nouveau stock: <input placeholder="Stock"  name="Stock" type="text" size="4" maxlength="4"/> </p>
                <p><input type="submit" value="Ajouter Stock" /></p>
                </form>
        <?php
            }
        }
        ?>

       </p>
   </div>
</div>
<?php endforeach; ?>
