<?php
require_once("inc/db.php");
require_once("inc/dbUtils.php");

function getAllMedicamentos(){

    $query = "SELECT id, nome ".
            "FROM medicamento";

    $stmt = db()->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQL_ASSOC);
}

function getMedicamentosAtual($num_utente){

    $query = "SELECT idMedAtual, data_começo, motivo, idMedicamento, num_utente, nome ".
        "FROM medicacaoatual JOIN medicamento ON medicacaoatual.idMedicamento = medicamento.id ".
        "WHERE medicacaoatual.num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_utente);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getMedicamentosAntigo($num_utente){

    $query = "SELECT idMedAntiga, data_comeco, data_fim, motivo, idMedicacao, num_utente, nome ".
        "FROM medicacaoantiga JOIN medicamento ON medicacaoantiga.idMedicacao = medicamento.id ".
        "WHERE medicacaoantiga.num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_utente);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQL_ASSOC);
}

function getMedAntiga($id){
    
    $query = "SELECT idMedAntiga, data_comeco, data_fim, motivo, idMedicacao, num_utente, nome ".
        "FROM medicacaoantiga JOIN medicamento ON medicacaoantiga.idMedicacao = medicamento.id ".
        "WHERE medicacaoantiga.idMedAntiga = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getMedAtual($id){
    $query = "SELECT idMedAtual, data_começo, motivo, idMedicamento, num_utente, nome ".
        "FROM medicacaoatual JOIN medicamento ON medicacaoatual.idMedicamento = medicamento.id ".
        "WHERE medicacaoatual.idMedAtual = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}