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

$tituloPagina = " Gestão Pacientes";
$linha = array();
$nome = '';
$num_utente = '';
$data = array();
$msgErros = array();
$dadosSubmetidos = false;
$morada='';
$paciente = '';
$s='checked';
$data_nascimento='';
$codigo_postal='';
$genero='';
$nacionalidade='';
$naturalidade='';
$num_cc='';
$num_seg_social='';
$nif='';
$contato_emergencia='';
$tipoSangue= '';
$pacientes = getAllPacientes();
$joao = "<br>";
$var = '';
$opc='';
$numero='';
//var_dump($_SESSION);

$msgGlobal = "Se pretende alterar o Numero de Utente deste paciente, contacte o Adm. da Base de Dados";
$tipoMsgGlobal = "A";


if(isset($_SESSION["flash_msgGlobal"])){
    $msgGlobal = $_SESSION["flash_msgGlobal"];
    unset($_SESSION["flash_msgGlobal"]);
}

if(isset($_SESSION["flash_tipoMsgGlobal"])){
    $tipoMsgGlobal = $_SESSION["flash_tipoMsgGlobal"];
    unset($_SESSION["flash_tipoMsgGlobal"]);
}


if (isset($_GET['num_utente'])){

    $num_utente = $_GET['num_utente'];
    //$morada = getPacienteMorada($num_utente);
    $paciente = getAllPacientesNum_utente($num_utente);

    //var_dump($paciente[0]);
    //var_dump($paciente);
    unset($_SESSION['num_utente']);
    $_SESSION['num_utente'] = $num_utente;
    //unset($_SESSION['num_utente']);

   // var_dump($_SESSION);

    $pacienteCerto = $paciente[0];
    $_SESSION['paciente'] = $paciente[0];

   // var_dump($pacienteCerto);
   // var_dump($paciente);
   // var_dump($num_utente);
   
}else {
    $paciente= array();

}
//veresta merda por causa das conparacoes.... funcao get paciente 
if(!empty($_POST)) {
    $dadosSubmetidos = true;
    $data = $_POST;
    $nr = $_SESSION['num_utente'];

    if(isUserAdministrativo())
    $msgErros = validarPacienteEditar($data['nome'],$data['data_nascimento'],$data['morada'],$data['codigo_postal'],$data['genero'],$data['nacionalidade'],$data['naturalidade'],$data['num_cc'],$data['num_seg_social'],$data['nif'],$data['contato_emergencia'],$data['tipo_sangue']);

    if(isUserMedico() || isUserEnfermeiro())

        $msgErros = validarPacienteEditar($_SESSION['num_utente'],$data['nome'],$data['data_nascimento'],$data['morada'],$data['codigo_postal'],$data['genero'],$data['nacionalidade'],$data['naturalidade'],$data['num_cc'],$data['num_seg_social'],$data['nif'],$data['contato_emergencia']);

       // var_dump($num_utente);
       // var_dump($msgErros);
       // var_dump($_GET);

    if(count($msgErros) > 0){


        $_SESSION["flash_msgGlobal"] = "Existem valores inválidos no formulário";
        $_SESSION["flash_tipoMsgGlobal"] = "A";

        //var_dump($_SESSION['num_utente']);
       // var_dump($nr);


    }
    else {

        if(isUserAdministrativo()) {
            $pacienteAlterado = alterarPaciente($nr,$data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia'], $data['tipo_sangue']);
        }
        if (isUserEnfermeiro() || isUserMedico()) {
            $pacienteAlterado = alterarPacienteME($nr, $data['nome'], $data['data_nascimento'], $data['morada'], $data['codigo_postal'], $data['genero'], $data['nacionalidade'], $data['naturalidade'], $data['num_cc'], $data['num_seg_social'], $data['nif'], $data['contato_emergencia']);
        }



        $_SESSION["flash_msgGlobal"] = "O Paciente foi Editado com sucesso";
        $_SESSION["flash_tipoMsgGlobal"] = "S";
        header("Location: pacientes_detalhe.php?num_utente=$nr");
        exit;
       // $nr = $data['num_utente'];


    }








}



require("view/top.template.php");
require("view/pacientes_detalhe.view");
require("view/bottom.template.php");