<?php


require_once("model/autenticacao.model.php");
require_once("model/pacientes.model.php");
require_once("inc/controllerInit.php");



if(isUserAnonimo()){
	$_SESSION["flash_loginMessage"] = "Não está autorizado a entrar nesta página";
	$_SESSION["flash_loginRedirectTo"] = $_SERVER["REQUEST_URI"];
	header("Location: login.php");
	exit;
}

// Variáveis usadas pelo do template
$tituloPagina = " Gestão Pacientes";

$nome = '';
$num_utente = '';
$ver = '';
$data = array();
$msgErros = array();
$dadosSubmetidos = false;
$tipoSangue = '';
$var = '';
$opc='';
//var_dump($_SESSION);

$pacientes = getAllPacientes();
$msgGlobal = "Confirme sempre se o Numero de Utente é o correto antes de submeter, caso seja preciso alterar depois de submetido, apenas junto do Adm. da Base de Dados.";
$tipoMsgGlobal = "A";


if(isset($_SESSION["flash_msgGlobal"])){
	$msgGlobal = $_SESSION["flash_msgGlobal"];
	unset($_SESSION["flash_msgGlobal"]);
}

if(isset($_SESSION["flash_tipoMsgGlobal"])){
	$tipoMsgGlobal = $_SESSION["flash_tipoMsgGlobal"];
	unset($_SESSION["flash_tipoMsgGlobal"]);
}

if(isset($_GET['opc'])  && isset($_GET['var'])  ){
	$var = $_GET['var'];
	$opc = $_GET['opc'];

	if ($opc == 'nome' || $opc == 'naturalidade' || $opc == 'nacionalidade'){
		if($var!='') {
			$pacientesAbre = getALLVarNome($var);
			$a = count($pacientesAbre);
			$msgGlobal = "Pacientes encontrados: " . $a;
			$tipoMsgGlobal = "S";
		}else{
			$pacientesAbre = getALLVarNome($var);
			$a = count($pacientesAbre);
			$msgGlobal = "Pacientes encontrados: 0";
			$tipoMsgGlobal = "A";
			
			
		}

	}else if($opc=='num_cc'){


		$pacientesAbre = getALLVarCC($var);
		$a=count($pacientesAbre);
		$msgGlobal = "Pacientes encontrados: ".$a;
		$tipoMsgGlobal = "S";

	}else if($opc=='nif'){

		$pacientesAbre = getALLVarNif($var);
		$a=count($pacientesAbre);
		$msgGlobal = "Pacientes encontrados: ".$a;
		$tipoMsgGlobal = "S";


	}else if($opc=='num_seg_social'){

		$pacientesAbre = getALLVarSocial($var);
		$a=count($pacientesAbre);
		$msgGlobal = "Pacientes encontrados: ".$a;
		$tipoMsgGlobal = "S";

	}else{

		$pacientesAbre = getALLVarNrs($var);
		$a=count($pacientesAbre);
		$msgGlobal = "Pacientes encontrados: ".$a;
		$tipoMsgGlobal = "S";

	}
	

}
if(isset($_GET['var'])  && $opc==''    ){

	$msgGlobal = "Seleccione primeiro o campo que pretende pesquisar";
	$tipoMsgGlobal = "E";
	$pacientesAbre = getAllPacientes();

}

if (isset($_GET['num_utente'])){
	$num_utente = $_GET['num_utente'];
}

if($nome != '') {
	$pacientesAbre = getAllPacientesNome($nome);
}

if(!empty($_POST)) {//Form Subemtido - Pedido POST
	$dadosSubmetidos = true;
	$data = $_POST;
	if(isUserAdministrativo()) {
		$msgErros = validarPacienteJ($data['num_utente'], $data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia'], $data['tipo_sangue']);
	}else{
		$msgErros = validarPacienteJ($data['num_utente'], $data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia']);
	}

	if(count($msgErros) > 0){
		$msgGlobal = "Existem valores inválidos no formulário";
		$tipoMsgGlobal = "A";

	}
	else {
		if(isUserAdministrativo()) {
			$novoPaciente = addPaciente($data['num_utente'], $data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia'], $data['tipo_sangue']);

		}else{
			$novoPaciente = addPacienteME($data['num_utente'], $data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia']);

		}
		if ($novoPaciente == true){

			if ($data["alergia"] != "") {
				$novoIDAlergia = addAlergia($data["num_utente"],$data["alergia"]);

				if ($novoIDAlergia != -1) {

					$_SESSION["msg_alergia_inserida"] = "A alergia foi inserida com sucesso";
					$_SESSION["tipoMsgGlobal_alergia_inserida"] = "S";
				} else {
					$_SESSION["msg_alergia_inserida"] = "Houve um problema a inserir a alergia  ";
					$_SESSION["tipoMsgGlobal_alergia_inserida"] = "E";
				}
			}

			$nr = $data['num_utente'];

			$_SESSION["flash_msgGlobal"] = "Paciente foi inserido com sucesso";
			$_SESSION["flash_tipoMsgGlobal"] = "S";


			header("Location: pacientes.php");
			
			exit;
		}
		else{
			$msgGlobal = "Houve um problema a criar Paciente";
			$tipoMsgGlobal = "E";
		}
		


	}

}

require("view/top.template.php");
require("view/pacientes.view.php");
require("view/bottom.template.php");
