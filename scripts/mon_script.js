
$(document).ready(function() {

   // Dès le chargement on masque l'élément portant l'id #masque
   // grâce à la fonction hide() de jQuery
   $("#masque").hide();

   // On déclare un gestionnaire d'événement click sur un lien
   // pour afficher l'élément précédemment masqué
   $("a#afficher").click(function() {

      // La fonction click() appliquée à notre sélecteur $("a#afficher")
      // prend en argument une fonction anonyme (sans nom) contenant
      // le reste des instructions :

      $("#masque").show("fast");

      // L'argument "fast" est facultatif mais nous permet
      // d'afficher l'élément avec une petite animation

  	  return false;
	  
      // On retourne 'false' pour prévenir l'exécution du lien
      // c'est à dire pour éviter au navigateur de changer de
      // page en suivant son attribut href

   });

   // Faites bien attention à la syntaxe et à l'imbrication des
   // parenthèses et accolades

});
