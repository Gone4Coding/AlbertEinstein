<?php 
	require_once("model/autenticacao.model.php");

	require_once("inc/controllerInit.php");

	// Iniciação das variáveis obrigatórios na vista:
	//$tituloPagina = "Albert Einstein Hospital";
	$userInfo='';
	$data = array();
	$data["redirectTo"]="";
	$msgErros = array();
	$dadosSubmetidos= false;
	if (empty($_POST)) { // Formulário não foi submetido - é um pedido GET
		if (isset($_SESSION["flash_loginRedirectTo"])){
			$data["redirectTo"]= $_SESSION["flash_loginRedirectTo"];
			unset($_SESSION["flash_loginRedirectTo"]);
		}
		if (isset($_SESSION["flash_loginMessage"]))	{
			$msgGlobal= $_SESSION["flash_loginMessage"];	
			unset($_SESSION["flash_loginMessage"]);
			$tipoMsgGlobal="E";
		}
	}
	else 
		if (!empty($_POST)) { // Formulário foi submetido - é um pedido POST
			$dadosSubmetidos= true;
			$data = $_POST;
			$msgErros = validarLogin($data["username"], $data["password"]);

			//var_dump($data);
			//var_dump($userInfo);
			if (count($msgErros)>0){
				$msgGlobal= "Existem valores inválidos no formulário";
				$tipoMsgGlobal = "A";

			}
			else {

				$userInfo = getUserInfoFromCredenciais($data["username"], $data["password"]);
				if ($userInfo == null){
					$msgGlobal= "Credenciais Inválidas";
					$tipoMsgGlobal = "E";
					//var_dump($data);
					//var_dump($userInfo);
				}
				else {
					$_SESSION['UserInfo'] = $userInfo;
					if (trim($data["redirectTo"]) != "") {
						header("Location: " . $data["redirectTo"]);
						exit;

					}
					$msgGlobal = "Login efetuado com sucesso";
					$tipoMsgGlobal = "S";
					$data = array();
				}						
			}
		}

	// Variáveis utilizadas pela vista login.view.php

	// $tituloPagina (preenchimento obrigatória) - Titulo da página
	// $msgErros (preenchimento obrigatória) - array com as mensagens de erro de validação associado a cada campo
				// a chave é igual ao nome do campo
				// O array pode estar vazio - não tem nenhuma mensagem de erro
	// $data (preenchimento obrigatório) - array com os valores dos campos  
				// a chave é igual ao nome do campo
				// o campo escondido "operacao" é sempre preenchido
				// os restantes campos poderão ficar vazios (não foram ainda preenchidos)
	// $dadosSubmetidos (preenchimento obrigatório) - indica se submeteu ou não os dados do formulário

	// $msgGlobal (preenchimento opcional) - String com uma mensagem de aviso/erro/sucesso relativa a toda a página
	// $tipoMsgGlobal (preenchimento opcional) - Tipo da mensagem global ($msgGlobal):
			// A - Aviso
			// E - Erro
	 		// I - Informação 
			// S - Sucesso
	require("view/top.template.php");
	require("view/login.view.php");
	require("view/bottom.template.php");
