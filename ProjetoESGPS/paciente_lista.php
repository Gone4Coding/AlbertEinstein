<?php

require_once("model/pacientes.model.php");
require_once("inc/controllerInit.php");

$tituloPagina = "Pacientes";
$numUtente = "";

if (isset($_GET['numUtente'])) {
    $numUtente = $_GET['numUtente'];
}

$pacientes = getAllPacientes();

if ($numUtente != '') {
    $pacientesEscolhido = getPaciente($numUtente);
    $pacientes   = $pacientesEscolhido;
}

require("view/top.template.php");
require("view/paciente_lista.view.php");//alterar
require("view/bottom.template.php");