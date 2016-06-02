<?php

	require_once("model/autenticacao.model.php");
	require_once("model/utilizadores.model.php");

	require_once("inc/controllerInit.php");

if(!isUserAdministrador()){
	$_SESSION["flash_loginMessage"] = "Não está autorizado a entrar nesta página";
	$_SESSION["flash_loginRedirectTo"] = $_SERVER["REQUEST_URI"];
	header("Location: login.php");
	exit;
}


	$username ="";
	$id="";
$data = array();
$msgErros = array();
$dadosSubmetidos = false;





$utilizador = getAllUsers();



	if (isset($_GET['username'])){

		$username=$_GET['username'];
}

if($username != '') {
	$utilizadorAbre = filterUtilizadoresNome($username);
}



var_dump($_GET);


	
	// Variáveis usadas pelo do template
	$tituloPagina = "Utilizadores";

	require("view/top.template.php");
	require("view/utilizadores.view.php");
	require("view/bottom.template.php");
   