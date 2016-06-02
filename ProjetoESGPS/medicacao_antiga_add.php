<?php
require_once("inc/controllerInit.php");
require_once("model/pacientes.model.php");
require_once("model/medicamentos.model.php");

$tituloPagina = "Adicionar Medicação Antiga";

if(isset($_GET["num_utente"])){
    $num_utente = $_GET["num_utente"];
    unset($_GET["num_utente"]);
}else{
    $num_utente = $_SESSION["num_utente_para_alterar"];
}

if(isset($_SESSION["flash_msgGlobal"])){
    $msgGlobal = $_SESSION["flash_msgGlobal"];
    unset($_SESSION["flash_msgGlobal"]);
}

if(isset($_SESSION["flash_tipoMsgGlobal"])){
    $tipoMsgGlobal = $_SESSION["flash_tipoMsgGlobal"];
    unset($_SESSION["flash_tipoMsgGlobal"]);
}

$paciente = getPaciente($num_utente);
$medicamentos = getAllMedicamentos();
$medicamentosPaciente = getMedicamentosAntigo($num_utente);

$data = array();
$msgErros = array();
$dadosSubmetidos = false;

if (!empty($_POST)) {
    $dadosSubmetidos = true;
    $data = $_POST;

    $msgErros = validarMedAntiga($data["data_comeco"],$data["data_fim"],$data["motivo"]);

    if (count($msgErros) > 0) {
        $msgGlobal = "Existem valores inválidos no formulário";
        $tipoMsgGlobal = "A";
    } else {
        $novoMedInserido = addMedAntiga($data["data_comeco"], $data["data_fim"],$data["motivo"],$data["idmedicamento"], $num_utente);

        if ($novoMedInserido != -1) {
            $_SESSION["flash_msgGlobal"] = "A Medicação foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: medicacao_antiga_add.php");
            exit;
        } else {
            $msgGlobal = "Houve um problema a inserir a medicação";
            $tipoMsgGlobal = "E";
        }
    }
}

$medicamentosPaciente = getMedicamentosAntigo($num_utente);

require("view/top.template.php");
require("view/medicacao_antiga_add.view.php");
require("view/bottom.template.php");