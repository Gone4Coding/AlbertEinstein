<?php
require_once("inc/controllerInit.php");
require_once("model/pacientes.model.php");

$tituloPagina = "Alterar Exames";

if (isset($_GET["num_utente"])) {
    $num_utente = $_GET["num_utente"];
    $id_exame = $_GET["idExame"];
    unset($_GET["num_utente"]);
    $_SESSION["exame_para_alterar"] = $id_exame;
} else {
    $num_utente = $_SESSION["num_utente_para_alterar"];
    $id_exame = $_SESSION["exame_para_alterar"];
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
$todosExmes = getAllEspecialidades();
$examesPaciente = getExames($num_utente);
$exameUnico = getExame($id_exame);

$data = array();
$msgErros = array();
$dataFiles = array();
$dadosSubmetidos = false;

if (!empty($_POST)) {
    $dadosSubmetidos = true;
    $data = $_POST;
    $dataFiles = $_FILES;

    $msgErros = validarExame($data["data_exame"], $dataFiles["exame_fisico"]["tmp_name"]);

    if (count($msgErros) > 0) {
        $msgGlobal = "Existem valores inválidos no formulário";
        $tipoMsgGlobal = "A";

    } else {
        $novoExameInserido = updateExame($data["data_exame"], $dataFiles["exame_fisico"]["tmp_name"], $id_exame, $data["tipo_exame"]);

        if ($novoExameInserido != -1) {
            $_SESSION["flash_msgGlobal"] = "O Exame foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: exame_add.php?num_utente=" . $num_utente);
            exit;
        } else {
            $_SESSION["flash_msgGlobal"] = "Houve um problema a inserir o exame";
            $_SESSION["flash_tipoMsgGlobal"] = "E";
        }
    }
}

$examesPaciente = getExames($num_utente);

require("view/top.template.php");
require("view/exame_alterar.view.php");
require("view/bottom.template.php");