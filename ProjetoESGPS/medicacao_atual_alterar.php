<?php
require_once("inc/controllerInit.php");
require_once("model/pacientes.model.php");
require_once("model/medicamentos.model.php");

$tituloPagina = "Alterar Medicação Atual";

if (isset($_GET["num_utente"])) {
    $num_utente = $_GET["num_utente"];
    $idMedAtual = $_GET["idMedAtual"];
    unset($_GET["num_utente"]);
    $_SESSION["medAtual_alterar"] = $idMedAtual;
} else {
    $num_utente = $_SESSION["num_utente_para_alterar"];
    $idMedAtual = $_SESSION["medAtual_alterar"];
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
$medicamentosPaciente = getMedicamentosAtual($num_utente);
$medicamentoUnico = getMedAtual($idMedAtual);

$data = array();
$msgErros = array();
$dadosSubmetidos = false;

if (!empty($_POST)) {
    $dadosSubmetidos = true;
    $data = $_POST;
    $msgErros = validarMedAtual($data["data_comeco"], $data["motivo"]);

    if (count($msgErros) > 0) {
        $msgGlobal = "Existem valores inválidos no formulário";
        $tipoMsgGlobal = "A";
    } else {
        $novoMedInserido = updateMedAtual($data["data_comeco"], $data["motivo"], $data["idmedicamento"], $idMedAtual);

        if ($novoMedInserido != -1) {
            $_SESSION["flash_msgGlobal"] = "A Medicação foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: medicacao_atual_add.php?num_utente=" . $num_utente);
            exit;
        } else {
            $_SESSION["flash_msgGlobal"] = "Houve um problema a inserir a medicação";
            $_SESSION["flash_tipoMsgGlobal"] = "E";
        }
    }
}

$medicamentosPaciente = getMedicamentosAtual($num_utente);

require("view/top.template.php");
require("view/medicacao_atual_alterar.view.php");
require("view/bottom.template.php");
