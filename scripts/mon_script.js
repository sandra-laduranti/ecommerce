
$(document).ready(function() {

   // D�s le chargement on masque l'�l�ment portant l'id #masque
   // gr�ce � la fonction hide() de jQuery
   $("#masque").hide();

   // On d�clare un gestionnaire d'�v�nement click sur un lien
   // pour afficher l'�l�ment pr�c�demment masqu�
   $("a#afficher").click(function() {

      // La fonction click() appliqu�e � notre s�lecteur $("a#afficher")
      // prend en argument une fonction anonyme (sans nom) contenant
      // le reste des instructions :

      $("#masque").show("fast");

      // L'argument "fast" est facultatif mais nous permet
      // d'afficher l'�l�ment avec une petite animation

  	  return false;
	  
      // On retourne 'false' pour pr�venir l'ex�cution du lien
      // c'est � dire pour �viter au navigateur de changer de
      // page en suivant son attribut href

   });

   // Faites bien attention � la syntaxe et � l'imbrication des
   // parenth�ses et accolades

});
