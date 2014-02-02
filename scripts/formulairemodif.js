
$(function() {
					var testmail = false;
					var testpswd = false;
					$('#submit').prop('disabled', true);
					$('#mail').blur(function(){
						var mail = $('#mail').val();
						var regexp =  new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$"); 
						if ((regexp.test(mail)) || (mail == "")){
							$('#errormail').text("");
							testmail = true;
						}
						else{
							$('#errormail').text("Votre mail est invalide");
							testmail = false;
						}
					});
					$('#confirmation').blur(function(){
						var pswdconf = $('#confirmation').val();
						var pswd = $('#mdp').val(); 
						if (pswdconf == pswd){
							$('#errorpswd').text("");
							testpswd = true;
						}
						else{
							$('#errorpswd').text("Le mot de passe n'est pas identique");
							testpswd = false;
						}
					});
					$('#formmodif :input').each(function(){ 
						$(this).blur(function(){
							var test = true;
							$('#formmodif :input').each(function(){
								if ($(this).val() == ""){
									test = false;
								}
							});
							if (testmail && testpswd && test){
								$('#submit').prop('disabled',false);
							}
							else {
								$('#submit').prop('disabled',true);
							}
							if (test == false){
								$("#globalerror").text("Vous n'avez pas saisi tous les champs");
							}
							else{
								$("#globalerror").text("");
							}
						});
					});
				});
