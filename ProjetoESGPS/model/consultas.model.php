<?php

require_once("inc/db.php");
require_once("inc/dbUtils.php");

function addConsulta($num_utente,$sintomas,$diagnostico,$medicamento)
{

    try {
        $query = "INSERT INTO consulta (num_utente,sintomas,diagnostico,idmedicamento " .
            "VALUES(?,?,?,?);" ;

        $stmt = db()->prepare($query);
        //$stmt->bind_param("issi", $num_utente, $sintomas, $diagnostico, $medicamento);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw  new Exception("Erro - Algo aconteceu na inserção");
        }
    } catch (Exception $e) {
       return false;
    }
    return true;
}