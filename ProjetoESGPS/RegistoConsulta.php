<?php
require_once("inc/controllerInit.php");
require_once("model/consultas.model.php");

$tituloPagina="Registo Consulta";

$num_utente="";

if (isset($_GET['num_utente'])){

    $num_utente = $_GET['num_utente'];
}


$data=array();

if(!empty($_GET)){

    $data=$_GET;

    $novaConsulta=addConsulta($numUtente,$data["sintomas"],$data["diagnostico"],$data["medicamento"]);

    if($novaConsulta!=false){
        $msg="Consulta Inserida com sucesso";
    }else{
        $msgerro="Consulta nao inserida";
    }

}else{
    $msgerro="Vazio.";
}

require("view/top.template.php");
require("view/bottom.template.php");










require("view/top.template.php");
require("view/registoconsulta.view.php");
require("view/bottom.template.php");
