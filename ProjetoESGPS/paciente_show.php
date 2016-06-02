<?php

require_once("model/pacientes.model.php");
require_once("inc/controllerInit.php");

$tituloPágina = "Detalhes do Paciente";
$data = array();

//Variaveis que vem da sessao
//Paciente
if (isset($_SESSION["flash_msgGlobal"])) {
    $msgGlobal = $_SESSION["flash_msgGlobal"];
    unset($_SESSION["flash_msgGlobal"]);
}

if (isset($_SESSION["flash_tipoMsgGlobal"])) {
    $tipoMsgGlobal = $_SESSION["flash_tipoMsgGlobal"];
    unset($_SESSION["flash_tipoMsgGlobal"]);
}

//Historico
if(isset($_SESSION["msg_historico_inserido"])){
    $msgGlobalHistorico = $_SESSION["msg_historico_inserido"];
    unset($_SESSION["msg_historico_inserido"]);
}

if (isset($_SESSION["tipoMsgGlobal_historico_inserido"])) {
    $tipoMsgGlobalHistorico = $_SESSION["tipoMsgGlobal_historico_inserido"];
    unset($_SESSION["tipoMsgGlobal_historico_inserido"]);
}

//Alergia
if(isset($_SESSION["msg_alergia_inserida"])){
    $msgGlobalAlergia = $_SESSION["msg_alergia_inserida"];
    unset($_SESSION["msg_alergia_inserida"]);
}

if (isset($_SESSION["tipoMsgGlobal_alergia_inserida"])) {
    $tipoMsgGlobalAlergia = $_SESSION["tipoMsgGlobal_alergia_inserida"];
    unset($_SESSION["tipoMsgGlobal_alergia_inserida"]);
}

//Exame
if(isset($_SESSION["msg_exame_inserido"])){
    $msgGlobalExame = $_SESSION["msg_exame_inserido"];
    unset($_SESSION["msg_exame_inserido"]);
}

if (isset($_SESSION["tipoMsgGlobal_exame_inserido"])) {
    $tipoMsgGlobalExame = $_SESSION["tipoMsgGlobal_exame_inserido"];
    unset($_SESSION["tipoMsgGlobal_exame_inserido"]);
}

//MedAtual
if(isset($_SESSION["msg_medAtual_inserido"])){
    $msgGlobalMedAtual = $_SESSION["msg_medAtual_inserido"];
    unset($_SESSION["msg_medAtual_inserido"]);
}

if (isset($_SESSION["tipoMsgGlobal_medAtual_inserido"])) {
    $tipoMsgGlobalMedAual = $_SESSION["tipoMsgGlobal_medAtual_inserido"];
    unset($_SESSION["tipoMsgGlobal_medAtual_inserido"]);
}

//MedAntiga
if(isset($_SESSION["msg_medAntiga_inserido"])){
    $msgGlobalMedAntiga = $_SESSION["msg_medAntiga_inserido"];
    unset($_SESSION["msg_medAntiga_inserido"]);
}

if (isset($_SESSION["tipoMsgGlobal_medAntiga_inserido"])) {
    $tipoMsgGlobalMedAntiga = $_SESSION["tipoMsgGlobal_medAntiga_inserido"];
    unset($_SESSION["tipoMsgGlobal_medAntiga_inserido"]);
}

if (isset($_GET["num_utente"])) {
    $data = getPaciente($_GET["num_utente"]);
}

if ($data == null) {
    header("Location: notFound.php");
    exit;
}

require("view/top.template.php");
require("view/paciente_show.view.php");
require("view/bottom.template.php");


