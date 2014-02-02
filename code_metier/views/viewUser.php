<?php $this->_title = "Connexion" ?>

<div id="connexion">

		<p>CONNEXION</p>
		<form action="/alcool_minimvc/user/connexion" method="POST">
		<p> <input placeholder="Mail" name="mail" type="text" size="14"  autofocus /></p>
		<p> <input placeholder="Password" name="mdp" type="password" size="9" /></p>
		<p> <input id="connect" type="submit" value="Connexion" /></p>
		</form>
 </div>
  <div id="inscription">
			   		<br>
		            <a href="#" id="afficher">INSCRIPTION</a>
		            <div id="masque">
						<form id="forminscr" action="/alcool_minimvc/user/inscription" method="POST">
							<p> <select name="civilite">
							<option value=Monsieur>M.</option>
							<option value=Madame>Mme.</option>
							<option value=Mademoiselle>Mlle.</option>
							</select> </p>
							<p> <input placeholder="Nom" name="nom" type="text" size="40" maxlength="20"/> </p>
							<p> <input placeholder="Prénom" name="prenom" type="text" size="40" maxlength="20" /> </p>
							<p> <input placeholder="Année de naissance" id="annee" name="naissance" type="text"  maxlength="4" minlength="4" size='40'/> <span id='errorannee'></span></p> 
							<p> <input placeholder="Adresse" name="adresse" type="text" size="40" maxlength="40"/> </p>
							<p> <input placeholder="Code Postal" name="postal" type="text" maxlength="5" minlength="5" size='40'/> </p>
							<p> <input placeholder="Ville" name="ville" type="text" size="40" maxlength="20"/> </p>
							<p> <input placeholder="Mail" id="mail" name="mail" type="text" size="40" maxlength="20"/><span id='errormail'></span> </p>
							<p> <input placeholder="Password" id="mdp" name="mdp" type="password" size="40" maxlength="20"/> </p>
							<p> <input placeholder="Confirmation pswd" id="confirmation" name="confirmation" type="password" size="40" maxlength="20"/> <span id='errorpswd'></span></p>
							<p id="globalerror"> </p>
							<INPUT id="submit" type="submit" value="S'inscrire" />
						</form>
		 	   		</div>
		</div>

<script type="text/javascript" src="/alcool_minimvc/scripts/formulaireinscript.js"></script>
