<?php
require_once("inc/db.php");
require_once("inc/dbUtils.php");

//Adicionar, Atualizar e Validar Pacientes
function addPaciente($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero,
                     $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergencia,
                     $tipo_sangue)
{

    if (isset($contato_emergencia) ? $contato_emergenciaInserido = $contato_emergencia : $contato_emergenciaInserido = null) ;
    if (isset($tipo_sangue) ? $tipo_sangueInserido = $tipo_sangue : $tipo_sangueInserido = null) ;

    try {
        $query = "INSERT INTO paciente (num_utente,nome,data_nascimento,morada,codigo_postal, genero, " .
            "nacionalidade, naturalidade, num_cc, num_seg_social,nif,contato_emergencia,tipo_sangue) " .
            "VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("isssssssiiiis", $num_utente, $nome, $data_nascimento, $morada, $codigo_postal,
            $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergenciaInserido,
            $tipo_sangueInserido);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw  new Exception("Erro - Algo aconteceu na inserção");
        }
    } catch (Exception $e) {
        false;
    }

    return true;

}

function addPacienteME($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero,
                       $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergencia)
{
    if (isset($contato_emergencia) ? $contato_emergenciaInserido = $contato_emergencia : $contato_emergenciaInserido = null) ;

    try {
        $query = "INSERT INTO paciente (num_utente,nome,data_nascimento,morada,codigo_postal, genero, " .
            "nacionalidade, naturalidade, num_cc, num_seg_social,nif,contato_emergencia) " .
            "VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("isssssssiiii", $num_utente, $nome, $data_nascimento, $morada, $codigo_postal,
            $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergenciaInserido);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw  new Exception("Erro - Algo aconteceu na inserção");
        }
    } catch (Exception $e) {
        false;
    }

    return true;

}

function validarPaciente($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade,
                         $naturalidade, $num_cc, $num_seg_social, $nif, $tipo_sangue)
{//fica
    $arrayMensagens = array();

    if (trim($num_utente) == "") {
        $arrayMensagens["num_utente"] = "O Numero de Utente é Obrigatório";
    } elseif (strlen(trim($num_utente)) != 9) {
        $arrayMensagens["num_utente"] = "O Numero de Utente tem de ter 9 digitos";
    }

    if (trim($nome) == "") {
        $arrayMensagens["nome"] = "O Nome é Obrigatório";
    } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nome))) === 0) {
        $arrayMensagens["nome"] = "O Nome só pode conter Letras";
    }

    $datas = explode("-", $data_nascimento);
    if (trim($data_nascimento) == "") {
        $arrayMensagens["data_nascimento"] = "A Data de Nacimento é Obrigatória";
    } elseif ($datas[0] < 1900) {
        $arrayMensagens["data_nascimento"] = "A Data de Nascimento tem de ser maior que 1900";
    }

    if (trim($morada) == "") {
        $arrayMensagens["morada"] = "A Morada é Obrigatória";
    }

    if (trim($codigo_postal) == "") {
        $arrayMensagens["codigo_postal"] = "O Codigo Postal é Obrigatório";
    } elseif ((preg_match("/^([0-9]{4})-([0-9]{3})*$/", trim($codigo_postal))) === 0) {
        $arrayMensagens["codigo_postal"] = "O Codigo Postal tem de ter o formato: 9999-999";
    }

    if (trim($genero) == "") {
        $arrayMensagens["genero"] = "O Genero é Obrigatório";
    }

    if (trim($nacionalidade) == "") {
        $arrayMensagens["nacionalidade"] = "A Nacionalidade é Obrigatória";
    } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nacionalidade))) === 0) {
        $arrayMensagens["nacionalidade"] = "O Nacionalidade só pode conter Letras";
    }

    if (trim($naturalidade) == "") {
        $arrayMensagens["naturalidade"] = "A Naturalidade é Obrigatória";
    } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($naturalidade))) === 0) {
        $arrayMensagens["naturalidade"] = "O Naturalidade só pode conter Letras";
    }

    if (trim($num_cc) == "") {
        $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão é Obrigatório";
    } elseif (strlen(trim($num_cc)) != 12) {
        $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão tem de ter 12 digitos";
    }

    if (trim($num_seg_social) == "") {
        $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social é Obrigatório";
    } elseif (strlen(trim($num_seg_social)) != 15) {
        $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social tem de ter 15 digitos";
    }

    if (trim($nif) == "") {
        $arrayMensagens["nif"] = "O NIF é Obrigatório";
    } elseif (strlen(trim($nif)) != 15) {
        $arrayMensagens["nif"] = "O NIF tem de ter 15 digitos";
    }


    return $arrayMensagens;
}

function validarPacienteEditar($num_utente,$nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade,
                               $naturalidade, $num_cc, $num_seg_social, $nif, $tipo_sangue){//fica
    $arrayMensagens = array();

    $resNif = getNif($nif);
    $res1 = count($resNif);

    $resSeg = getSeg($num_seg_social);
    $res3 = count($resSeg);
    $resCC = getCC($num_cc);
    $res4 = count($resCC);

    //$igual = getPaciente($num_utente);
    $igual1 = getPacienteC($num_utente);
    $igual2 = getPacienteSeg($num_utente);
    $igual3 =getPacienteNEGADO($num_utente,$nif);
    $res5 = count($igual3);
    $igual4 = getPacienteNEGADOcc($num_utente,$num_cc);
    $res6 = count($igual4);
    $igual5 = getPacienteNEGADOseg($num_utente,$num_seg_social);
    $res7 = count($igual5);

    var_dump($igual5);
    var_dump($res7);
    var_dump($res6);





    /*
        if (trim($num_utente) == "") {
            $arrayMensagens["num_utente"] = "O Numero de Utente é Obrigatório";
        } elseif (strlen(trim($num_utente)) != 9) {
            $arrayMensagens["num_utente"] = "O Numero de Utente tem de ter 9 digitos";
        }

        if (trim($nome) == "") {
            $arrayMensagens["nome"] = "O Nome é Obrigatório";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nome))) === 0) {
            $arrayMensagens["nome"] = "O Nome só pode conter Letras";
        }

        $datas = explode("-", $data_nascimento);
        if (trim($data_nascimento) == "") {
            $arrayMensagens["data_nascimento"] = "A Data de Nacimento é Obrigatória";
        } elseif ($datas[0] < 1900) {
            $arrayMensagens["data_nascimento"] = "A Data de Nascimento tem de ser maior que 1900";
        }

        if (trim($morada) == "") {
            $arrayMensagens["morada"] = "A Morada é Obrigatória";
        }

        if (trim($codigo_postal) == "") {
            $arrayMensagens["codigo_postal"] = "O Codigo Postal é Obrigatório";
        } elseif ((preg_match("/^([0-9]{4})-([0-9]{3})*$/", trim($codigo_postal))) === 0) {
            $arrayMensagens["codigo_postal"] = "O Codigo Postal tem de ter o formato: 9999-999";
        }

        if (trim($genero) == "") {
            $arrayMensagens["genero"] = "O Genero é Obrigatório";
        }

        if (trim($nacionalidade) == "") {
            $arrayMensagens["nacionalidade"] = "A Nacionalidade é Obrigatória";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nacionalidade))) === 0) {
            $arrayMensagens["nacionalidade"] = "O Nacionalidade só pode conter Letras";
        }

        if (trim($naturalidade) == "") {
            $arrayMensagens["naturalidade"] = "A Naturalidade é Obrigatória";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($naturalidade))) === 0) {
            $arrayMensagens["naturalidade"] = "O Naturalidade só pode conter Letras";
        }

        if (trim($num_cc) == "") {
            $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão é Obrigatório";
        } elseif (strlen(trim($num_cc)) != 12) {
            $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão tem de ter 12 digitos";
        }

        if (trim($num_seg_social) == "") {
            $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social é Obrigatório";
        } elseif (strlen(trim($num_seg_social)) != 15) {
            $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social tem de ter 15 digitos";
        }

        if (trim($nif) == "") {
            $arrayMensagens["nif"] = "O NIF é Obrigatório";
        } elseif (strlen(trim($nif)) != 15) {
            $arrayMensagens["nif"] = "O NIF tem de ter 15 digitos";
        }
    */





    if(trim($num_utente)==""){
        $arrayMensagens["num_utente"] = "O Numero de Utente é Obrigatório";
    }

    if(trim( $nome)==""){
        $arrayMensagens["nome"] = "O Nome é Obrigatório";
    }

    if(trim($data_nascimento)==""){
        $arrayMensagens["data_nascimento"] = "A Data de Nacimento é Obrigatória";
    }

    if(trim($morada)==""){
        $arrayMensagens["morada"] = "A Morada é Obrigatória";
    }

    if(trim($codigo_postal)==""){
        $arrayMensagens["codigo_postal"] = "O Codigo Postal é Obrigatório";
    }

    if(trim($genero)==""){
        $arrayMensagens["genero"] = "O Genero é Obrigatório";
    }

    if(trim($nacionalidade)==""){
        $arrayMensagens["nacionalidade"] = "A Nacionalidade é Obrigatória";
    }

    if(trim($naturalidade)==""){
        $arrayMensagens["naturalidade"] = "A Naturalidade é Obrigatória";
    }
    if(trim($num_cc)==""){
        $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão é Obrigatório";
    }

    if(trim($num_seg_social)==""){
        $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social é Obrigatório";
    }

    if(trim($nif)==""){
        $arrayMensagens["nif"] = "O NIF é Obrigatório";
    }



    if($res5 != 0){  //$nif != $igual[0]){

        $arrayMensagens["nif"] = "Ja existe um paciente com o NIF que esta a tentar inserir";
    }



    if($res6 !=0 ){

        $arrayMensagens["num_cc"] = "Ja existe um paciente com o Numero de CC/BI que esta a tentar inserir";
    }

    if($res7 != 0 ){

        $arrayMensagens["num_seg_social"] = "Ja existe um paciente com o Numero de Seg. Social que esta a tentar inserir";
    }



    return $arrayMensagens;
}
function validarPacienteJ($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade,
                          $naturalidade, $num_cc, $num_seg_social, $nif, $tipo_sangue){//fica
    $arrayMensagens = array();
    $resNif = getNif($nif);
    $res1 = count($resNif);
    $resNum_u = getNum($num_utente);
    $res2 = count($resNum_u);
    $resSeg = getSeg($num_seg_social);
    $res3 = count($resSeg);
    $resCC = getCC($num_cc);
    $res4 = count($resCC);




        if (trim($num_utente) == "") {
            $arrayMensagens["num_utente"] = "O Numero de Utente é Obrigatório";
        } elseif (strlen(trim($num_utente)) != 9) {
            $arrayMensagens["num_utente"] = "O Numero de Utente tem de ter 9 digitos";
        }

        if (trim($nome) == "") {
            $arrayMensagens["nome"] = "O Nome é Obrigatório";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nome))) === 0) {
            $arrayMensagens["nome"] = "O Nome só pode conter Letras";
        }

        $datas = explode("-", $data_nascimento);
        if (trim($data_nascimento) == "") {
            $arrayMensagens["data_nascimento"] = "A Data de Nacimento é Obrigatória";
        } elseif ($datas[0] < 1900) {
            $arrayMensagens["data_nascimento"] = "A Data de Nascimento tem de ser maior que 1900";
        }

        if (trim($morada) == "") {
            $arrayMensagens["morada"] = "A Morada é Obrigatória";
        }

        if (trim($codigo_postal) == "") {
            $arrayMensagens["codigo_postal"] = "O Codigo Postal é Obrigatório";
        } elseif ((preg_match("/^([0-9]{4})-([0-9]{3})*$/", trim($codigo_postal))) === 0) {
            $arrayMensagens["codigo_postal"] = "O Codigo Postal tem de ter o formato: 9999-999";
        }

        if (trim($genero) == "") {
            $arrayMensagens["genero"] = "O Genero é Obrigatório";
        }

        if (trim($nacionalidade) == "") {
            $arrayMensagens["nacionalidade"] = "A Nacionalidade é Obrigatória";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($nacionalidade))) === 0) {
            $arrayMensagens["nacionalidade"] = "O Nacionalidade só pode conter Letras";
        }

        if (trim($naturalidade) == "") {
            $arrayMensagens["naturalidade"] = "A Naturalidade é Obrigatória";
        } elseif ((preg_match("/^[a-zA-Z ]*$/", trim($naturalidade))) === 0) {
            $arrayMensagens["naturalidade"] = "O Naturalidade só pode conter Letras";
        }

        if (trim($num_cc) == "") {
            $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão é Obrigatório";
        } elseif (strlen(trim($num_cc)) != 12) {
            $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão tem de ter 12 digitos";
        }

        if (trim($num_seg_social) == "") {
            $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social é Obrigatório";
        } elseif (strlen(trim($num_seg_social)) != 15) {
            $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social tem de ter 15 digitos";
        }

        if (trim($nif) == "") {
            $arrayMensagens["nif"] = "O NIF é Obrigatório";
        } elseif (strlen(trim($nif)) != 15) {
            $arrayMensagens["nif"] = "O NIF tem de ter 15 digitos";
        }

    /*
    if(trim($num_utente)==""){
        $arrayMensagens["num_utente"] = "O Numero de Utente é Obrigatório";
    }

    if(trim( $nome)==""){
        $arrayMensagens["nome"] = "O Nome é Obrigatório";
    }

    if(trim($data_nascimento)==""){
        $arrayMensagens["data_nascimento"] = "A Data de Nacimento é Obrigatória";
    }

    if(trim($morada)==""){
        $arrayMensagens["morada"] = "A Morada é Obrigatória";
    }

    if(trim($codigo_postal)==""){
        $arrayMensagens["codigo_postal"] = "O Codigo Postal é Obrigatório";
    }

    if(trim($genero)==""){
        $arrayMensagens["genero"] = "O Genero é Obrigatório";
    }

    if(trim($nacionalidade)==""){
        $arrayMensagens["nacionalidade"] = "A Nacionalidade é Obrigatória";
    }

    if(trim($naturalidade)==""){
        $arrayMensagens["naturalidade"] = "A Naturalidade é Obrigatória";
    }
    if(trim($num_cc)==""){
        $arrayMensagens["num_cc"] = "O Numero do Cartão de Cidadão é Obrigatório";
    }

    if(trim($num_seg_social)==""){
        $arrayMensagens["num_seg_social"] = "O Numero de Seguranca Social é Obrigatório";
    }

    if(trim($nif)==""){
        $arrayMensagens["nif"] = "O NIF é Obrigatório";
    }
*/
    if($res1 != 0){

        $arrayMensagens["nif"] = "Ja existe um paciente com o NIF que esta a tentar inserir";
    }

    if($res2 != 0){

        $arrayMensagens["num_utente"] = "Ja existe um paciente com o Numero de Utente que esta a tentar inserir";
    }

    if($res4 != 0){

        $arrayMensagens["num_cc"] = "Ja existe um paciente com o Numero de CC/BI que esta a tentar inserir";
    }

    if($res3 != 0){

        $arrayMensagens["num_seg_social"] = "Ja existe um paciente com o Numero de Seg. Social que esta a tentar inserir";
    }



    return $arrayMensagens;
}

function alterarPaciente($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergencia, $tipo_sangue)
{//fica


    if (isset($contato_emergencia) ? $contato_emergenciaInserido = $contato_emergencia : $contato_emergenciaInserido = null) ;

    try {
        $query = "UPDATE paciente " .
            "SET num_utente=?, nome=?, data_nascimento=?, morada=?, codigo_postal=?, genero=?, nacionalidade=?, naturalidade=?, num_cc=?, num_seg_social=?, nif=?, contato_emergencia=?, tipo_sangue=? " .
            "WHERE num_utente=?";
        $stmt = db()->prepare($query);
        $stmt->bind_param("isssssssiiiisi", $num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergenciaInserido, $tipo_sangue, $num_utente);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception("Erro - Algo aconteceu");
        }
    } catch (Exception $e) {
        return -1;
    }

    return db()->insert_id;
}

function alterarPacienteME($num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergencia)
{//fica

    try {
        $query = "UPDATE paciente " .
            "SET num_utente=?, nome=?, data_nascimento=?, morada=?, codigo_postal=?, genero=?, nacionalidade=?, naturalidade=?, num_cc=?, num_seg_social=?, nif=?, contato_emergencia=? " .
            "WHERE num_utente=?";
        $stmt = db()->prepare($query);
        $stmt->bind_param("isssssssiiiii", $num_utente, $nome, $data_nascimento, $morada, $codigo_postal, $genero, $nacionalidade, $naturalidade, $num_cc, $num_seg_social, $nif, $contato_emergencia, $num_utente);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception("Erro - Algo aconteceu");
        }
    } catch (Exception $e) {
        return false;
    }

    return true;
}

//Adicionar e Validar Alergias
function addAlergia($num_utente, $descricao)
{

    try {
        $query = "INSERT INTO alergia(descricao,num_utente) " .
            "VALUES (?,?); ";

        $stmt = db()->prepare($query);
        $stmt->bind_param("si", $descricao, $num_utente);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception("ERRO - Alergia nao inserida");
        }
    } catch (Exception $e) {
        return -1;
    }
    return db()->insert_id;
}

//Adicionar e Validar Historico
function addHistorico($num_utente)
{
    try {
        $query = "INSERT INTO historicoclinico (num_utente) " .
            "VALUES (?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("i", $num_utente);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception ("ERRO - Historico nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }

    return db()->insert_id;
}

function updateHistorico($diretoria, $id){

    $query = "UPDATE historicoclinico ".
        "SET historico = ? ".
        "WHERE idHistorico = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("si", $diretoria, $id);
    $stmt->execute();
}
//Adicionar e Validar Exames
function addExame($data_exame, $num_utente, $tipo_exame)
{
    try {
        $query = "INSERT INTO exame (data_exame, num_utente, idEspecialidade) " .
            "VALUES (?,?,?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("sii", $data_exame, $num_utente, $tipo_exame);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }

    return db()->insert_id;
}

function addExameFisico($diretoria, $id){
    
    $query = "UPDATE exame ".
        "SET exame_fisico = ? ".
        "WHERE idExame = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("si", $diretoria, $id);
    $stmt->execute();
    
}

function updateExame($data_exame, $exame_fisico, $idExame, $tipo_exame)
{

    try {
        $query = "UPDATE exame " .
            "SET data_exame = ?, exame_fisico = ?, idEspecialidade = ? " .
            "WHERE 	idExame = ?";

        $stmt = db()->prepare($query);
        $stmt->bind_param("ssii", $data_exame, $exame_fisico, $tipo_exame, $idExame);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }

    return db()->insert_id;
}

function validarExame($data_exame, $exame_fisico)
{
    $arrayMensagens = array();

    if (trim($data_exame) == "") {
        $arrayMensagens["data_exame"] = "A Data é Obrigatoria";
    }

    if (trim($exame_fisico) == "") {
        $arrayMensagens["exame_fisico"] = "A Inserção do Exame é Obrigatoria";
    }

    return $arrayMensagens;
}

//Adicionar Med. Antiga
function addMedAntiga($data_comeco, $data_fim, $motivo, $idMedicacao, $num_utente)
{
    try {
        $query = "INSERT INTO medicacaoantiga(data_comeco,data_fim,motivo,	idMedicacao,num_utente) VALUES (?,?,?,?,?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("sssii", $data_comeco, $data_fim, $motivo, $idMedicacao, $num_utente);
        $stmt->execute();

        if (db()->affected_rows != 1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }
    return db()->insert_id;
}

function updateMedAntiga($data_comeco, $data_fim, $motivo, $idMedicacao, $idMedAntiga)
{

    try {
        $query = "UPDATE medicacaoantiga " .
            "SET data_comeco = ?, data_fim = ?, motivo = ?, idMedicacao = ? " .
            "WHERE idMedAntiga = ?";

        $stmt = db()->prepare($query);
        $stmt->bind_param("sssii", $data_comeco, $data_fim, $motivo, $idMedicacao, $idMedAntiga);
        $stmt->execute();

        if (db()->affected_rows == -1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }
    return db()->insert_id;
}

function validarMedAntiga($data_comeco, $data_fim, $motivo)
{
    $arrayMensagens = array();

    if (trim($data_comeco) == "") {
        $arrayMensagens["data_comeco"] = "A Data é Obrigatoria";
    }

    if (trim($data_fim) == "") {
        $arrayMensagens["data_fim"] = "A Data é Obrigatoria";
    }

    if(trim($data_comeco) > trim($data_fim)){
        $arrayMensagens["data_comeco"] = "A Data de Início não pode ser maior que a Data de Fim";
    }

    if (trim($motivo) == "") {
        $arrayMensagens["motivo"] = "A Inserção do Exame é Obrigatoria";
    }

    return $arrayMensagens;
}

//Adicionar Med. Atual
function addMedAtual($data_comeco, $motivo, $idMedicacao, $num_utente)
{
    try {
        $query = "INSERT INTO medicacaoatual(data_começo,motivo, idMedicamento,num_utente) VALUES(?,?,?,?);";

        $stmt = db()->prepare($query);
        $stmt->bind_param("ssii", $data_comeco, $motivo, $idMedicacao, $num_utente);
        $stmt->execute();

        if (db()->affected_rows == -1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }
    return db()->insert_id;
}

function updateMedAtual($data_comeco, $motivo, $idMedicacao, $idMedAtual)
{

    try {
        $query = "UPDATE medicacaoatual " .
            "SET data_comeco = ?, motivo = ?, idMedicamento = ? " .
            "WHERE idMedAtual = ?";

        $stmt = db()->prepare($query);
        $stmt->bind_param("ssii", $data_comeco, $motivo, $idMedicacao, $idMedAtual);
        $stmt->execute();

        if (db()->affected_rows == -1) {
            throw new Exception ("ERRO - Exame nao inserido");
        }
    } catch (Exception $e) {
        return -1;
    }
    return db()->insert_id;
}

function validarMedAtual($data_comeco, $motivo)
{
    $arrayMensagens = array();

    if (trim($data_comeco) == "") {
        $arrayMensagens["data_comeco"] = "A Data é Obrigatoria";
    }

    if (trim($motivo) == "") {
        $arrayMensagens["motivo"] = "A Inserção do Exame é Obrigatoria";
    }

    return $arrayMensagens;
}

//---------------------------------------

function getPaciente($num_utente)
{
    $query = "SELECT num_utente,nome,tipo_sangue,data_nascimento,morada,codigo_postal,genero, " .
        "nacionalidade,naturalidade,num_cc,num_seg_social,nif,contato_emergencia " .
        "FROM paciente " .
        "WHERE num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i", $num_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getAllPacientes()
{

    $query = "SELECT num_utente,nome,tipo_sangue " .
        "FROM paciente";

    $stmt = db()->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getPacienteNEGADO($num_utente,$nif)
{
    $query = "SELECT nif
        FROM paciente 
        WHERE NOT num_utente = ? AND nif = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("ii", $num_utente, $nif);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getPacienteNEGADOcc($num_utente,$num_cc)
{
    $query = "SELECT num_cc
        FROM paciente 
        WHERE NOT num_utente = ? AND num_cc = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("ii", $num_utente, $num_cc);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getPacienteNEGADOseg($num_utente,$num_seg_social)
{
    $query = "SELECT num_seg_social
        FROM paciente 
        WHERE NOT num_utente = ? AND num_seg_social = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("ii", $num_utente, $num_seg_social);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getPacienteC($num_utente)
{
    $query = "SELECT num_cc
        FROM paciente 
        WHERE num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i", $num_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}
function getPacienteSeg($num_utente)
{
    $query = "SELECT num_seg_social
        FROM paciente 
        WHERE num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i", $num_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getAllPacientesNum_utente($num_utente){//fica

    $query = "SELECT  *
 
    FROM paciente WHERE num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getAllPacientesNome($nome){
    $nome = "%$nome%";

    $query = "SELECT  num_utente, nome, codigo_postal,nacionalidade
 
    FROM paciente WHERE nome LIKE ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getNif($nif){//fica

    $query = "SELECT  nif
 
    FROM paciente WHERE nif = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$nif);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getCC($num_cc){//fica

    $query = "SELECT  num_cc
 
    FROM paciente WHERE num_cc = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_cc);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getSeg($num_seg_social){//fica

    $query = "SELECT  num_seg_social
 
    FROM paciente WHERE num_seg_social = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_seg_social);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getNum($num_utente){//fica

    $query = "SELECT  num_utente
 
    FROM paciente WHERE num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$num_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getALLVarNome($var){//fica

    $var = "%$var%";

    $query = "SELECT  *
 
    FROM paciente WHERE nome LIKE ? OR nacionalidade LIKE ? OR naturalidade LIKE ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("sss",$var, $var,$var);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getALLVarNrs($var){//fica



    $query = "SELECT  *
 
    FROM paciente WHERE num_utente = ? ";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$var);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getALLVarCC($var){//fica



    $query = "SELECT  *
 
    FROM paciente WHERE  num_cc = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$var);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getALLVarSocial($var){//fica



    $query = "SELECT  *
 
    FROM paciente WHERE  num_seg_social = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$var);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getALLVarNif($var){//fica



    $query = "SELECT  *
 
    FROM paciente WHERE  nif = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i",$var);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

//-------------------------------------

function getAllEspecialidades()
{
    $query = "SELECT id_especialidade, especialidade " .
        "FROM especialidade";

    $stmt = db()->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getExames($num_utente)
{
    $query = "SELECT idExame, data_exame, num_utente, exame_fisico, idEspecialidade, especialidade " .
        "FROM exame JOIN especialidade ON exame.idEspecialidade = especialidade.id_especialidade " .
        "WHERE exame.num_utente = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i", $num_utente);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);
}

function getExame($id)
{

    $query = "SELECT idExame, data_exame, num_utente, exame_fisico, idEspecialidade, especialidade " .
        "FROM exame JOIN especialidade ON exame.idEspecialidade = especialidade.id_especialidade " .
        "WHERE exame.idExame = ?";

    $stmt = db()->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQL_ASSOC);

}



