<?php
require_once("inc/controllerInit.php");
require_once("model/pacientes.model.php");
require_once("model/medicamentos.model.php");

$tituloPagina = "Alterar Medicação Antiga";

if (isset($_GET["num_utente"])) {
    $num_utente = $_GET["num_utente"];
    $idMedAntiga = $_GET["idMedAntiga"];
    unset($_GET["num_utente"]);
    $_SESSION["medAntiga_alterar"] = $idMedAntiga;
} else {
    $num_utente = $_SESSION["num_utente_para_alterar"];
    $idMedAntiga = $_SESSION["medAntiga_alterar"];
}

if (isset($_SESSION["flash_msgGlobal"])) {
    $msgGlobal = $_SESSION["flash_msgGlobal"];
    unset($_SESSION["flash_msgGlobal"]);
}

if (isset($_SESSION["flash_tipoMsgGlobal"])) {
    $tipoMsgGlobal = $_SESSION["flash_tipoMsgGlobal"];
    unset($_SESSION["flash_tipoMsgGlobal"]);
}

$paciente = getPaciente($num_utente);
$medicamentos = getAllMedicamentos();
$medicamentosPaciente = getMedicamentosAntigo($num_utente);
$medicamentoUnico = getMedAntiga($idMedAntiga);

$data = array();
$msgErros = array();
$dadosSubmetidos = false;

if (!empty($_POST)) {
    $dadosSubmetidos = true;
    $data = $_POST;

    $msgErros = validarMedAntiga($data["data_comeco"], $data["data_fim"], $data["motivo"]);

    if (count($msgErros) > 0) {
        $msgGlobal = "Existem valores inválidos no formulário";
        $tipoMsgGlobal = "A";
    } else {
        $novoMedInserido = updateMedAntiga($data["data_comeco"], $data["data_fim"], $data["motivo"], $data["idmedicamento"], $idMedAntiga);
        
        if ($novoMedInserido != -1) {
            $_SESSION["flash_msgGlobal"] = "A Medicação foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: medicacao_antiga_add.php?num_utente=" . $num_utente);
            exit;
        } else {
            $_SESSION["flash_msgGlobal"] = "Houve um problema a inserir a medicação";
            $_SESSION["flash_tipoMsgGlobal"] = "E";
        }
    }
}

$medicamentosPaciente = getMedicamentosAntigo($num_utente);

require("view/top.template.php");
require("view/medicacao_antiga_alterar.view.php");
require("view/bottom.template.php");