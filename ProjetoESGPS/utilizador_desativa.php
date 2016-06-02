<?php 
	require_once("model/utilizadores.model.php");
	require_once("inc/controllerInit.php");
	require_once("model/autenticacao.model.php");

	if (!isUserMedico()||!isUserEnfermeiro()||!isUserAdministrativo()){
  	$_SESSION["flash_loginMessage"]="Não está autorizado a alterar Utilizadores";
  	$_SESSION["flash_loginRedirectTo"]= $_SERVER["REQUEST_URI"];
  	header("Location: login.php");
  	exit;	
  }
	
	$ativarOk=1;
	if (!empty($_GET)){
		if (isset($_GET["id"])){
			$ativarOk = desativaUser($_GET["id"]);
		}		
	} 		


	if ($ativarOk){
		header("Location: utilizadores.php");
		exit;			
	}

