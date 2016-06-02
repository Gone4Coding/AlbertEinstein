  <?php 
  require_once("model/utilizadores.model.php");
  require_once("inc/controllerInit.php");
  require_once("model/autenticacao.model.php");

  if (isUserMedico()||isUserEnfermeiro()||isUserAdministrativo() || isUserAnonimo()){
  	$_SESSION["flash_loginMessage"]="Não está autorizado a alterar Utilizadores";
  	$_SESSION["flash_loginRedirectTo"]= $_SERVER["REQUEST_URI"];
  	header("Location: login.php");
  	exit;	
  }

  $tituloPagina = "Alterar Utilizador";
  $operacao = "U";
  $msgErros = array();
  $data = array();
  $dadosSubmetidos= false;
  $s='checked';
  $username = '';
  $id='';



  $utilizadores = getAllUsers();


  if (isset($_GET['id'])){

	  $username=$_GET['id'];

	  $utilizador = obtemUtilizador($id);
	  var_dump($utilizador);

  }

  if($username != '') {
	  $utilizadorAbre = filterUtilizadoresNome($username);
  }



  if (!empty($_POST)) { // Formulário foi submetido - é um pedido POST
		$dadosSubmetidos = true;
		$data = $_POST;

		$msgErros = validarUtilizador($data['username'],$data['tipo']);

		if(count($msgErros) > 0){
			//$nr = $data['num_utente'];

			header("Location: index.php");
			$msgGlobal = "Existem valores inválidos no formulário";
			$tipoMsgGlobal = "A";
		}else {

			$utilizadorAlterado = alterarUtilizador($data['username'],$data['tipo']);

			$_SESSION["flash_msgGlobal"] = "O utilizador foi editado com sucesso";
			$_SESSION["flash_tipoMsgGlobal"] = "S";



			exit;

		}
	}

			require("view/top.template.php");
			require("view/utilizador_detalhe.view.php");
			require("view/bottom.template.php");	