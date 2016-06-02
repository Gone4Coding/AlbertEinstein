<?php
require_once("model/autenticacao.model.php");
require_once("model/pacientes.model.php");
require_once("model/medicamentos.model.php");
require_once("inc/controllerInit.php");

//Variaveis
$tituloPágina = "Novo Utente";

if (isUserAnonimo()) {
    $_SESSION["flash_loginMessage"] = "Não está autorizado a entrar nesta página";
    $_SESSION["flash_loginRedirectTo"] = $_SERVER["REQUEST_URI"];
    header("Location: login.php");
    exit;
}

$data = array();
$msgErros = array();
$dataFiles = array();
$dadosSubmetidos = false;

$todosMedicamentos = getAllMedicamentos();
$todosExmes = getAllEspecialidades();

if (!empty($_POST)) {//Form Subemtido - Pedido POST
    $dadosSubmetidos = true;
    $data = $_POST;
    $dataFiles = $_FILES;

    $msgErros = validarPaciente($data["num_utente"], $data["nome"], $data["data_nascimento"], $data["morada"],
        $data["codigo_postal"], $data["genero"], $data["nacionalidade"], $data["naturalidade"], $data["num_cc"],
        $data["num_seg_social"], $data["nif"], $data["tipo_sangue"]);

    if (count($msgErros) > 0) {
        $msgGlobal = "Existem valores inválidos no formulário";
        $tipoMsgGlobal = "A";

    } else {
        $novoUtente = addPaciente($data["num_utente"], $data["nome"], $data["data_nascimento"], $data["morada"],
            $data["codigo_postal"], $data["genero"], $data["nacionalidade"], $data["naturalidade"], $data["num_cc"],
            $data["num_seg_social"], $data["nif"], $data["contato_emergencia"], $data["tipo_sangue"]);

        if ($novoUtente == true) {

            //Historico Clinico
            if (($dataFiles["historicoClinico"]["tmp_name"] != "")) {
                $novoHistorico = addHistorico($data["num_utente"]);

                if ($novoHistorico != -1) {

                    $target_dir = "uploads/historico/";
                    $target_file = $target_dir . $novoHistorico;
                    move_uploaded_file($dataFiles["historicoClinico"]["tmp_name"], $target_file);
                    addExameFisico($target_file, $novoHistorico);

                    $_SESSION["msg_historico_inserido"] = "O histórico foi inserido com sucesso";
                    $_SESSION["tipoMsgGlobal_historico_inserido"] = "S";
                } else {
                    $_SESSION["msg_historico_inserido"] = "Houve um problema a inserir o Histórico";
                    $_SESSION["tipoMsgGlobal_historico_inserido"] = "E";
                }
            }

            //Alergia
            if ($data["alergia"] != "") {
                $novoIDAlergia = addAlergia($data["num_utente"], $data["alergia"]);

                if ($novoIDAlergia != -1) {
                    $_SESSION["msg_alergia_inserida"] = "A alergia foi inserida com sucesso";
                    $_SESSION["tipoMsgGlobal_alergia_inserida"] = "S";
                } else {
                    $_SESSION["msg_alergia_inserida"] = "Houve um problema a inserir a alergia  ";
                    $_SESSION["tipoMsgGlobal_alergia_inserida"] = "E";
                }
            }

            //Form Exame
            if ($data["especialidade"] != "" && $data["dataExame"] != "") {

                $novoExameInserido = addExame($data["dataExame"], $data["num_utente"], $data["especialidade"]);

                if ($novoExameInserido != -1) {

                    $target_dir = "uploads/exames/";
                    $target_file = $target_dir . $novoExameInserido;
                    move_uploaded_file($dataFiles["caminhoExame"]["tmp_name"], $target_file);
                    addExameFisico($target_file, $novoExameInserido);

                    $_SESSION["msg_exame_inserido"] = "O Exame foi Inserido com Sucesso";
                    $_SESSION["tipoMsgGlobal_exame_inserido"] = "S";
                } else {
                    $_SESSION["msg_exame_inserido"] = "O Exame Não foi Inserido com Sucesso";
                    $_SESSION["tipoMsgGlobal_exame_inserido"] = "E";
                }
            } else {
                $_SESSION["msg_exame_inserido"] = "Se não Inseriu Todos os Dados do Exame, Pode Faze-lo na Listagem de Pacientes";
                $_SESSION["tipoMsgGlobal_exame_inserido"] = "I";
            }

            //Form MedAtual
            if ($data["medicamentoAtual"] != 0 && $data["dataToma"] != 0 && $data["motivoMedAtual"] != 0) {

                $novaMedAtualInserida = addMedAtual($data["dataToma"], $data["motivoMedAtual"], $data["medicamentoAtual"], $data["num_utente"]);

                if ($novaMedAtualInserida != -1) {
                    $_SESSION["msg_medAtual_inserido"] = "A Medicação Atual foi Inserida com Sucesso";
                    $_SESSION["tipoMsgGlobal_medAtual_inserido"] = "S";
                } else {
                    $_SESSION["msg_medAtual_inserido"] = "A Medicação Atual Não foi Inserida com Sucesso";
                    $_SESSION["tipoMsgGlobal_medAtual_inserido"] = "E";
                }
            } else {
                $_SESSION["msg_medAtual_inserido"] = "Se não Inseriu Todos os Dados da Medicação Atual, Pode Faze-lo na Listagem de Pacientes";
                $_SESSION["tipoMsgGlobal_medAtual_inserido"] = "I";
            }

            //Form MedAntiga
            if ($data["medicamentoAntigo"] != 0 && $data["dataTomaAntigo"] != 0 &&
                $data["dataFimTomaAntiga"] != 0 && $data["motivoMedAntigo"] != 0
            ) {

                $novaMedAntigaInserida = addMedAntiga($data["dataTomaAntigo"], $data["dataFimTomaAntiga"], $data["motivoMedAntigo"],
                    $data["medicamentoAntigo"], $data["num_utente"]);

                if ($novaMedAntigaInserida != -1) {
                    $_SESSION["msg_medAntiga_inserido"] = "A Medicação Antiga foi Inserida com Sucesso";
                    $_SESSION["tipoMsgGlobal_medAntiga_inserido"] = "S";
                } else {
                    $_SESSION["msg_medAntiga_inserido"] = "A Medicação Antiga Não foi Inserida com Sucesso";
                    $_SESSION["tipoMsgGlobal_medAntiga_inserido"] = "E";
                }
            } else {
                $_SESSION["msg_medAntiga_inserido"] = "Se não Inseriu Todos os Dados da Medicação Antiga, Pode Faze-lo na Listagem de Pacientes";
                $_SESSION["tipoMsgGlobal_medAntiga_inserido"] = "I";
            }
        }

        if ($novoUtente == true) {
            $num_utente = $data["num_utente"];
            $_SESSION["flash_msgGlobal"] = "O utente foi inserido com sucesso";
            $_SESSION["flash_tipoMsgGlobal"] = "S";
            header("Location: paciente_show.php?num_utente=" . $num_utente);
            exit;
        } else {
            $msgGlobal = "Houve um problema a criar o utente";
            $tipoMsgGlobal = "E";
        }
    }
}

// Variáveis utilizadas pela vista paciente_create.view.php

// $tituloPagina (preenchimento obrigatória) - Titulo da página
// $data (preenchimento obrigatório) - array com os valores dos campos  
// a chave é igual ao nome do campo
// os restantes campos poderão ficar vazios (não foram ainda preenchidos)
// $msgGlobal (preenchimento opcional) - String com uma mensagem de aviso/erro/sucesso relativa a toda a página
// $tipoMsgGlobal (preenchimento opcional) - Tipo da mensagem global ($msgGlobal):
// A - Aviso
// E - Erro
// I - Informação 
// S - Sucesso


require("view/top.template.php");
require("view/paciente_create.view.php");
require("view/bottom.template.php");