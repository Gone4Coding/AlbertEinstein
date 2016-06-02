<?php

require_once ("inc/controllerInit.php");
require_once ("model/pacientes.model.php");
require("view/top.template.php");
require("view/pesquisaUtente.view.php");
require("view/bottom.template.php");

$tituloPagina="Pesquisa Utente";

$utente = array();

if (isset($_GET['num_utente'])){
    $utente = getAllPacientesNum_utente($_GET['num_utente']);
    //$num_utente = $_GET['num_utente'];
}


//$utente = getAllPacientesNum_utente($num_utente);


if(count($utente)<=0){

    $msgerro = "Paciente não existente.";
    exit;

}else{

    header("Location: listarMedicamento.php?num_utente=$num_utente");
}




