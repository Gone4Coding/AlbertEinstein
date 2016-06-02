<?php
require_once("inc/controllerInit.php");
require_once("model/pacientes.model.php");

$tituloPagina = "Adicionar Exames";

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
$todosExmes = getAllEspecialidades();
$examesPaciente = getExames($num_utente);

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

        $novoExameInserido = addExame($data["data_exame"], $num_utente, $data["tipo_exame"]);

        if ($novoExameInserido != -1) {

            $target_dir = "uploads/exames/";
            $target_file = $target_dir . $novoExameInserido;
            move_uploaded_file($dataFiles["exame_fisico"]["tmp_name"], $target_file);
            addExameFisico($target_file, $novoExameInserido);

            $_SESSION["flash_msgGlobal"] = "O Exame foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: exame_add.php");
            exit;
        } else {
            $msgGlobal = "Houve um problema a inserir o exame";
            $tipoMsgGlobal = "E";
        }
    }
}

$examesPaciente = getExames($num_utente);

require("view/top.template.php");
require("view/exame_add.view.php");
require("view/bottom.template.php");