<?php 
	require_once("model/utilizadores.model.php");
	require_once("model/autenticacao.model.php");
	require_once("inc/controllerInit.php");

	if (isUserEnfermeiro()||isUserMedico()||isUserAdministrativo()|| isUserAnonimo()) {
		$_SESSION["flash_loginMessage"] = "Não está autorizado a aceder aos Detalhes do Utilizador";
		$_SESSION["flash_loginRedirectTo"] = $_SERVER["REQUEST_URI"];
		header("Location: login.php");
		exit;
	}
	 
	$tituloPagina = "Criar Utilizador";
	$operacao = "I";
	$data = array();
	$msgErros = array();
	$dadosSubmetidos= false;

	if (!empty($_POST)) { // Formulário foi submetido - é um pedido POST
		$dadosSubmetidos= true;
		$data = $_POST;
		$msgErros = validarUtilizador($data["username"], $data["password"], $data["tipo"]);
		


		if (count($msgErros)>0){
			$msgGlobal= "Existem valores inválidos no formulário";
			$tipoMsgGlobal = "A";
		}
		else {
			$novoID = inserirUtilizador($data["username"], $data["password"], $data["tipo"]);
			if ($novoID!=-1){
				$problemaNoUpload = false;
				/*if (isset($_FILES["foto"]))
					if ($_FILES["foto"]["username"] != "")
						$problemaNoUpload = !saveFotoFile($novoID, $_FILES["foto"]["username"], $_FILES["foto"]["tmp_name"]);*/
				if ($problemaNoUpload){
					$msgGlobal= "Houve um problema ao adicionar a foto";
					$tipoMsgGlobal = "E";							
				}
				else {
				$_SESSION["flash_msgGlobal"] = "O Utilizador foi criado com sucesso";
				$_SESSION["flash_tipoMsgGlobal"] = "S";
				header("Location: utilizadores.php?id=$novoID");
				exit;			
			}
		}
			else {
				$msgGlobal= "Houve um problema ao criar o Utilizador";
				$tipoMsgGlobal = "E";
			}						
		}
	}
 
		//$URLFoto = getURLFotoUser("");
	 
	require("view/top.template.php");
	
	require("view/bottom.template.php");
 