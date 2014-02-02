<?php

	session_start();
	header('Content-Type: text/html; charset=utf-8');

	//	TODO
	//	Use spl_autoload to autoload required class

	require '/code_metier/routeur/routeur.class.php';

	$routeur = new Routeur();
	$routeur->routing();

?>